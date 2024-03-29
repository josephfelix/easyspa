package com.riotech.easyspa.social;

import android.os.Bundle;
import android.widget.Toast;

import com.facebook.FacebookCallback;
import com.facebook.FacebookException;
import com.facebook.GraphRequest;
import com.facebook.GraphResponse;
import com.facebook.login.LoginManager;
import com.facebook.login.LoginResult;
import com.riotech.easyspa.LoginActivity;
import com.riotech.easyspa.location.EasySpaGPS;
import com.riotech.easyspa.location.EasySpaLocationCallback;
import com.riotech.easyspa.model.User;
import com.riotech.easyspa.permission.EasySpaLocationPermission;
import com.riotech.easyspa.permission.EasySpaPermissionCallback;
import com.riotech.easyspa.util.Constants;

import org.json.JSONException;
import org.json.JSONObject;

public class EasySpaFacebookCallback implements FacebookCallback<LoginResult>, Constants {

    private LoginActivity instance;
    private EasySpaLocationPermission permission;
    private EasySpaGPS gps;

    public EasySpaFacebookCallback(LoginActivity instance, EasySpaLocationPermission permission, EasySpaGPS gps) {
        this.instance = instance;
        this.permission = permission;
        this.gps = gps;
    }

    @Override
    public void onSuccess(LoginResult loginResult) {
        GraphRequest request = GraphRequest.newMeRequest(
                loginResult.getAccessToken(),
                new GraphRequest.GraphJSONObjectCallback() {
                    @Override
                    public void onCompleted(JSONObject object, GraphResponse response) {
                        try {

                            final User user = new User();
                            user.setUniqueID(object.getString("id"));
                            user.setFirstname(object.getString("first_name"));
                            user.setLastname(object.getString("last_name"));
                            user.setEmail(object.getString("email"));
                            user.setLoginMethod(LOGIN_WITH_FACEBOOK);

                            permission.onRequest(new EasySpaPermissionCallback() {

                                @Override
                                public void onGranted() {

                                    gps.setSuccessCallback(new EasySpaLocationCallback() {
                                        @Override
                                        public void run() {
                                            instance.loginUpsert(user);
                                        }
                                    });

                                    gps.setErrorCallback(new EasySpaLocationCallback() {
                                        @Override
                                        public void run() {
                                            LoginManager.getInstance().logOut();
                                        }
                                    });

                                    gps.getLocation();

                                }

                                @Override
                                public void onDenied() {
                                    LoginManager.getInstance().logOut();
                                }
                            });

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                });
        Bundle parameters = new Bundle();
        parameters.putString("fields", "id,first_name,last_name,email");
        request.setParameters(parameters);
        request.executeAsync();
    }

    @Override
    public void onCancel() {
        Toast.makeText(instance, "O processo foi cancelado pelo usuário", Toast.LENGTH_LONG).show();
    }

    @Override
    public void onError(FacebookException error) {
        Toast.makeText(instance, "Cheque sua internet para continuar", Toast.LENGTH_LONG).show();
    }

}