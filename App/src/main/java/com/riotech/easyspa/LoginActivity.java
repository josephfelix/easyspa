/**
 * Version information
 *
 * @package com.riotech.easyspa
 * @copyright 2016 Rio Tech
 * @author Joseph F.
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

package com.riotech.easyspa;

import android.app.ProgressDialog;
import android.content.Intent;
import android.location.Address;
import android.location.Geocoder;
import android.location.Location;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.facebook.login.LoginManager;
import com.google.android.gms.auth.api.Auth;
import com.google.android.gms.auth.api.signin.GoogleSignInOptions;
import com.google.android.gms.auth.api.signin.GoogleSignInResult;
import com.google.android.gms.common.SignInButton;
import com.google.android.gms.common.api.GoogleApiClient;
import com.riotech.easyspa.location.EasySpaGPS;
import com.riotech.easyspa.location.EasySpaGeoCoder;
import com.riotech.easyspa.model.User;
import com.riotech.easyspa.model.UserStatus;
import com.riotech.easyspa.permission.EasySpaLocationPermission;
import com.riotech.easyspa.social.EasySpaFacebookCallback;
import com.riotech.easyspa.social.EasySpaGoogleCallback;
import com.riotech.easyspa.util.Constants;
import com.riotech.easyspa.util.Session;
import com.riotech.easyspa.web.EasySpaAPI;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

import com.facebook.CallbackManager;
import com.facebook.FacebookSdk;
import com.facebook.login.widget.LoginButton;

import java.io.IOException;
import java.util.List;


/**
 * LoginActivity
 * Este é o controlador da tela de Login
 */
public class LoginActivity extends AppCompatActivity implements ActivityCompat.OnRequestPermissionsResultCallback, Constants {

    private Session session;
    private CallbackManager callbackManager;
    private GoogleApiClient mGoogleApiClient;
    private EasySpaLocationPermission permission;
    private EasySpaGPS gps;
    private ProgressDialog progressDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FacebookSdk.sdkInitialize(getApplicationContext());
        callbackManager = CallbackManager.Factory.create();
        setContentView(R.layout.activity_login);

        gps = new EasySpaGPS(this);

        session = new Session(this);
        permission = new EasySpaLocationPermission();
        permission.setActivity(this);

        // Se o usuário já tiver feito login anteriormente, ele será redirecionado
        // para a AppActivity
        detectUserLoggedIn();

        /**
         * Integração: Login com facebook
         */
        final LoginButton facebookLoginButton = (LoginButton) findViewById(R.id.login_facebook);
        facebookLoginButton.setReadPermissions("email");
        facebookLoginButton.registerCallback(callbackManager, new EasySpaFacebookCallback(LoginActivity.this, permission, gps));

        /**
         * Integração: Login com Google
         */
        GoogleSignInOptions gso = new GoogleSignInOptions.Builder(GoogleSignInOptions.DEFAULT_SIGN_IN)
                .requestEmail()
                .build();
        mGoogleApiClient = new GoogleApiClient.Builder(this)
                .enableAutoManage(this, new EasySpaGoogleCallback(this, permission, gps))
                .addApi(Auth.GOOGLE_SIGN_IN_API, gso)
                .build();

        SignInButton googleLoginButton = (SignInButton) findViewById(R.id.login_google);
        googleLoginButton.setSize(SignInButton.SIZE_STANDARD);
        googleLoginButton.setScopes(gso.getScopeArray());
        setGooglePlusButtonText(googleLoginButton, getString(R.string.login_with_google));

        googleLoginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (view.getId() == R.id.login_google) {
                    Intent signInIntent = Auth.GoogleSignInApi.getSignInIntent(mGoogleApiClient);
                    startActivityForResult(signInIntent, LOGIN_WITH_GOOGLE);
                }

            }
        });

        progressDialog = new ProgressDialog(this);
        progressDialog.setMessage("Carregando...");
        progressDialog.setCanceledOnTouchOutside(false);
    }

    /**
     * Altera o texto do botão de login com google
     *
     * @param signInButton
     * @param buttonText
     */
    protected void setGooglePlusButtonText(SignInButton signInButton, String buttonText) {
        for (int i = 0; i < signInButton.getChildCount(); i++) {
            View v = signInButton.getChildAt(i);

            if (v instanceof TextView) {
                TextView tv = (TextView) v;
                tv.setText(buttonText);
                return;
            }
        }
    }

    /**
     * Identifica se o usuário já se autenticou on sistema
     */
    private void detectUserLoggedIn() {
        if (session.isLoggedIn()) {
            Intent main = new Intent(this, AppActivity.class);
            startActivity(main);
        }
    }

    /**
     * Inicia uma instancia Retrofit
     *
     * @return EasySpaAPI
     */
    private EasySpaAPI getInterfaceService() {
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl(API_URL)
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        return retrofit.create(EasySpaAPI.class);
    }

    /**
     * Inicia o processo de login
     */
    public void loginUpsert(final User user) {
        EasySpaAPI mApiService = this.getInterfaceService();
        Call<UserStatus> mService = null;
        if (user.getLoginMethod() == LOGIN_WITH_FACEBOOK) {
            mService = mApiService.loginFacebook(user.getUniqueID(), user.getEmail());
        } else if (user.getLoginMethod() == LOGIN_WITH_GOOGLE) {
            mService = mApiService.loginGoogle(user.getUniqueID(), user.getEmail());
        }

        if (mService == null) {
            return;
        }

        // Exibe o loading
        progressDialog.show();

        mService.enqueue(new Callback<UserStatus>() {
            @Override
            public void onResponse(Call<UserStatus> call, Response<UserStatus> response) {
                processResponse(user, response);
            }

            @Override
            public void onFailure(Call<UserStatus> call, Throwable t) {
                call.cancel();
                Toast.makeText(LoginActivity.this, "Cheque sua internet para continuar", Toast.LENGTH_LONG).show();
            }
        });
    }

    /**
     * Processa o retorno do webservice retornado pelo Retrofit
     *
     * @param user     Usuário
     * @param response Response do status do usuário
     */
    private void processResponse(User user, Response<UserStatus> response) {

        double latitude = gps.getLatitude();
        double longitude = gps.getLongitude();
        String localidade = EasySpaGeoCoder.translateLocation(this, latitude, longitude);

        // Status do usuário
        int userStatus = response.body().getStatus();

        if (userStatus == UserStatus.LOGIN_SUCCESS) {

            // Guarda os dados do usuário logado
            session.set("logged", session.LOGIN);
            session.set("uniqueid", user.getUniqueID());
            session.set("firstname", user.getFirstname());
            session.set("lastname", user.getLastname());
            session.set("email", user.getEmail());
            session.set("loginmethod", user.getLoginMethod());
            session.set("location", localidade);

            // Redireciona para a tela principal
            Intent appIntent = new Intent(LoginActivity.this, AppActivity.class);
            startActivity(appIntent);

        } else if (userStatus == UserStatus.INVALID_USER) {

            // Esconde o loading
            progressDialog.dismiss();

            if (user.getLoginMethod() == LOGIN_WITH_FACEBOOK) {

                // Sai do facebook
                LoginManager.getInstance().logOut();

            } else if (user.getLoginMethod() == LOGIN_WITH_GOOGLE) {

                // Sai do google
                Auth.GoogleSignInApi.signOut(mGoogleApiClient);

            }

            // Exibe a mensagem
            Toast.makeText(LoginActivity.this, "Este usuário foi desabilitado do sistema", Toast.LENGTH_LONG).show();

        }
    }


    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == LOGIN_WITH_GOOGLE) {
            GoogleSignInResult result = Auth.GoogleSignInApi.getSignInResultFromIntent(data);
            (new EasySpaGoogleCallback(this, permission, gps)).process(result);
        } else if (requestCode == LOGIN_WITH_FACEBOOK) {
            callbackManager.onActivityResult(requestCode, resultCode, data);
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        permission.processRequestCode(requestCode, permissions, grantResults);
    }
}

