package com.riotech.easyspa.social;

import android.support.annotation.NonNull;
import android.util.Log;
import android.widget.Toast;

import com.google.android.gms.auth.api.Auth;
import com.google.android.gms.auth.api.signin.GoogleSignInAccount;
import com.google.android.gms.auth.api.signin.GoogleSignInResult;
import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.api.GoogleApiClient;
import com.riotech.easyspa.LoginActivity;
import com.riotech.easyspa.model.User;
import com.riotech.easyspa.permission.EasySpaLocationPermission;
import com.riotech.easyspa.permission.EasySpaPermissionCallback;
import com.riotech.easyspa.util.Constants;

public class EasySpaGoogleCallback implements Constants, GoogleApiClient.OnConnectionFailedListener {

    private LoginActivity instance;
    private EasySpaLocationPermission permission;

    public EasySpaGoogleCallback(LoginActivity instance, EasySpaLocationPermission permission) {
        this.instance = instance;
        this.permission = permission;
    }

    public void process(GoogleSignInResult result) {
        if (result.isSuccess()) {
            GoogleSignInAccount acct = result.getSignInAccount();
            if (acct != null) {
                final User user = new User();

                user.setFirstname(acct.getGivenName());
                user.setLastname(acct.getFamilyName());
                user.setEmail(acct.getEmail());
                user.setUniqueID(acct.getId());
                user.setLoginMethod(LOGIN_WITH_GOOGLE);

                this.permission.onRequest(new EasySpaPermissionCallback() {
                    @Override
                    public void onGranted() {
                        instance.loginUpsert(user);
                    }
                });
            }
        }
    }

    @Override
    public void onConnectionFailed(@NonNull ConnectionResult connectionResult) {
        Log.d("Error", connectionResult.getErrorMessage());
    }
}
