package com.riotech.easyspa.social;

import android.support.annotation.NonNull;
import android.util.Log;

import com.google.android.gms.auth.api.signin.GoogleSignInAccount;
import com.google.android.gms.auth.api.signin.GoogleSignInResult;
import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.api.GoogleApiClient;
import com.riotech.easyspa.LoginActivity;
import com.riotech.easyspa.location.EasySpaGPS;
import com.riotech.easyspa.location.EasySpaLocationCallback;
import com.riotech.easyspa.model.User;
import com.riotech.easyspa.permission.EasySpaLocationPermission;
import com.riotech.easyspa.permission.EasySpaPermissionCallback;
import com.riotech.easyspa.util.Constants;

public class EasySpaGoogleCallback implements Constants, GoogleApiClient.OnConnectionFailedListener {

    private LoginActivity instance;
    private EasySpaLocationPermission permission;
    private EasySpaGPS gps;

    public EasySpaGoogleCallback(LoginActivity instance, EasySpaLocationPermission permission, EasySpaGPS gps) {
        this.instance = instance;
        this.permission = permission;
        this.gps = gps;
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

                        gps.setSuccessCallback(new EasySpaLocationCallback() {
                            @Override
                            public void run() {
                                instance.loginUpsert(user);
                            }
                        });

                        gps.getLocation();

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
