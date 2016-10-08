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
import android.text.TextUtils;
import android.view.KeyEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.inputmethod.EditorInfo;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.riotech.easyspa.model.User;
import com.riotech.easyspa.util.Constants;
import com.riotech.easyspa.util.Session;
import com.riotech.easyspa.web.EasySpaAPI;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

/**
 * LoginActivity
 * Este é o controlador da tela de Login
 */
public class LoginActivity extends Activity implements LoaderCallbacks<Cursor>, Constants {
    public final int LOGIN_SUCCESS = 1;
    public final int INVALID_USER = 2;

    // Campos do formulário.
    private EditText fieldEmail;
    private EditText fieldPassword;
    private View mProgressView;
    private View mLoginFormView;

    private String email;
    private String password;

    private Session session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        session = new Session(this);

        // Se o usuário já tiver feito login anteriormente, ele será redirecionado
        // para a AppActivity
        detectUserLoggedIn();

        fieldEmail = (EditText) findViewById(R.id.email);
        fieldPassword = (EditText) findViewById(R.id.password);
        fieldPassword.setOnEditorActionListener(new TextView.OnEditorActionListener() {
            @Override
            public boolean onEditorAction(TextView textView, int id, KeyEvent keyEvent) {
                if (id == R.id.login || id == EditorInfo.IME_NULL) {
                    attemptLogin();
                    return true;
                }
                return false;
            }
        });

        Button mEmailSignInButton = (Button) findViewById(R.id.login_button);
        mEmailSignInButton.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View view) {
                attemptLogin();
            }
        });

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
     * Este método será chamado sempre que o usuário tentar realizar um login
     */
    private void attemptLogin() {

        // Reset errors.
        fieldEmail.setError(null);
        fieldPassword.setError(null);

        // Store values at the time of the login attempt.
        email = fieldEmail.getText().toString();
        password = fieldPassword.getText().toString();

        // Checa se o e-mail inserido é um e-mail válido
        if (!isValidEmail(email)) {
            fieldEmail.setError(getString(R.string.login_invalid_email));
            fieldEmail.requestFocus();
            return;
        }

        // Checa se a senha inserida é uma senha válida
        if (!isValidPassword(password)) {
            fieldPassword.setError(getString(R.string.login_require_password));
            fieldPassword.requestFocus();
            return;
        }

        showProgress(true);
        loginProcess(email, password);
    }

    /**
     * Valida se a senha informada é válida
     *
     * @param password
     * @return boolean
     */
    public boolean isValidPassword(String password) {

        if (TextUtils.isEmpty(password)) {
            return false;
        }

        if (password.length() <= 4) {
            return false;
        }

        return true;
    }

    /**
     * Valida se o e-mail informado é válido
     *
     * @param email
     * @return boolean
     */
    private boolean isValidEmail(String email) {
        if (TextUtils.isEmpty(email)) {
            return false;
        }

        if (!email.contains("@")) {
            return false;
        }

        return true;
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
     *
     * @param email
     * @param password
     */
    private void loginProcess(String email, String password) {
        EasySpaAPI mApiService = this.getInterfaceService();
        Call<User> mService = mApiService.login(email, password);
        mService.enqueue(new Callback<User>() {
            @Override
            public void onResponse(Call<User> call, Response<User> response) {
                User user = response.body();

                // Status do usuário
                int userStatus = user.getStatus();

                if (userStatus == LOGIN_SUCCESS) {

                    // Guarda os dados do usuário logado
                    session.set("logged", session.LOGIN);
                    session.set("name", user.getName());
                    session.set("email", user.getEmail());

                    // Redireciona para a tela principal
                    Intent loginIntent = new Intent(LoginActivity.this, AppActivity.class);
                    startActivity(loginIntent);

                } else if (userStatus == INVALID_USER) {

                    // Esconde o loading
                    showProgress(false);

                    // Exibe o erro de usuário incorreto
                    fieldEmail.setError(getString(R.string.login_or_password_incorrect));
                    fieldEmail.requestFocus();

                }
            }

            @Override
            public void onFailure(Call<User> call, Throwable t) {
                call.cancel();
                Toast.makeText(LoginActivity.this, "Please check your network connection and internet permission", Toast.LENGTH_LONG).show();
            }
        });
    }
}

