/**
 * Version information
 *
 * @package com.riotech.easyspa
 * @copyright 2016 Rio Tech
 * @author Joseph F.
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
package com.riotech.easyspa;

import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.annotation.TargetApi;
import android.app.Activity;
import android.app.LoaderManager.LoaderCallbacks;
import android.content.Intent;
import android.content.Loader;
import android.database.Cursor;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Toast;

import com.facebook.login.LoginManager;
import com.riotech.easyspa.model.User;
import com.riotech.easyspa.model.UserStatus;
import com.riotech.easyspa.social.EasySpaFacebookCallback;
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


/**
 * LoginActivity
 * Este é o controlador da tela de Login
 */
public class LoginActivity extends Activity implements LoaderCallbacks<Cursor>, Constants {

    private View mProgressView;
    private View mLoginFormView;

    private Session session;
    private CallbackManager callbackManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FacebookSdk.sdkInitialize(getApplicationContext());
        callbackManager = CallbackManager.Factory.create();
        setContentView(R.layout.activity_login);

        session = new Session(this);

        // Se o usuário já tiver feito login anteriormente, ele será redirecionado
        // para a AppActivity
        detectUserLoggedIn();

        LoginButton facebookLoginButton = (LoginButton) findViewById(R.id.login_facebook);
        facebookLoginButton.setReadPermissions("email");
        facebookLoginButton.registerCallback(callbackManager, new EasySpaFacebookCallback(this));

        mLoginFormView = findViewById(R.id.login_form);
        mProgressView = findViewById(R.id.login_progress);
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
     * Exibe o loading e oculta o formulário
     */
    @TargetApi(Build.VERSION_CODES.HONEYCOMB_MR2)
    private void showProgress(final boolean show) {
        // On Honeycomb MR2 we have the ViewPropertyAnimator APIs, which allow
        // for very easy animations. If available, use these APIs to fade-in
        // the progress spinner.
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.HONEYCOMB_MR2) {
            int shortAnimTime = getResources().getInteger(android.R.integer.config_shortAnimTime);

            mLoginFormView.setVisibility(show ? View.GONE : View.VISIBLE);
            mLoginFormView.animate().setDuration(shortAnimTime).alpha(
                    show ? 0 : 1).setListener(new AnimatorListenerAdapter() {
                @Override
                public void onAnimationEnd(Animator animation) {
                    mLoginFormView.setVisibility(show ? View.GONE : View.VISIBLE);
                }
            });

            mProgressView.setVisibility(show ? View.VISIBLE : View.GONE);
            mProgressView.animate().setDuration(shortAnimTime).alpha(
                    show ? 1 : 0).setListener(new AnimatorListenerAdapter() {
                @Override
                public void onAnimationEnd(Animator animation) {
                    mProgressView.setVisibility(show ? View.VISIBLE : View.GONE);
                }
            });
        } else {
            // The ViewPropertyAnimator APIs are not available, so simply show
            // and hide the relevant UI components.
            mProgressView.setVisibility(show ? View.VISIBLE : View.GONE);
            mLoginFormView.setVisibility(show ? View.GONE : View.VISIBLE);
        }
    }

    @Override
    public Loader<Cursor> onCreateLoader(int i, Bundle bundle) {
        return null;
    }

    @Override
    public void onLoadFinished(Loader<Cursor> loader, Cursor cursor) {
    }

    @Override
    public void onLoaderReset(Loader<Cursor> loader) {
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
    public void loginUpsert(final User user, int method) {
        EasySpaAPI mApiService = this.getInterfaceService();
        Call<UserStatus> mService = null;
        if (method == LOGIN_WITH_FACEBOOK) {
            mService = mApiService.loginFacebook(user.getUniqueID(), user.getEmail());
        } else if (method == LOGIN_WITH_GOOGLE) {
            mService = mApiService.loginGoogle(user.getUniqueID(), user.getEmail());
        }

        if (mService == null) {
            return;
        }

        // Exibe a barra de progresso
        showProgress(true);

        mService.enqueue(new Callback<UserStatus>() {
            @Override
            public void onResponse(Call<UserStatus> call, Response<UserStatus> response) {

                // Status do usuário
                int userStatus = response.body().getStatus();

                if (userStatus == UserStatus.LOGIN_SUCCESS) {

                    // Guarda os dados do usuário logado
                    session.set("logged", session.LOGIN);
                    session.set("uniqueid", user.getUniqueID());
                    session.set("firstname", user.getFirstname());
                    session.set("lastname", user.getLastname());
                    session.set("email", user.getEmail());

                    // Redireciona para a tela principal
                    Intent appIntent = new Intent(LoginActivity.this, AppActivity.class);
                    startActivity(appIntent);

                } else if (userStatus == UserStatus.INVALID_USER) {

                    // Esconde o loading
                    showProgress(false);

                    // Sai do facebook
                    LoginManager.getInstance().logOut();

                    // Exibe a mensagem
                    Toast.makeText(LoginActivity.this, "Este usuário foi desabilitado do sistema", Toast.LENGTH_LONG).show();

                }
            }

            @Override
            public void onFailure(Call<UserStatus> call, Throwable t) {
                call.cancel();
                Toast.makeText(LoginActivity.this, "Cheque sua internet para continuar", Toast.LENGTH_LONG).show();
            }
        });
    }


    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        callbackManager.onActivityResult(requestCode, resultCode, data);
    }
}

