package com.riotech.easyspa.model;

import android.text.TextUtils;

public class User {
    private String name;
    private String email;
    private String password;

    public void setName(String name) {
        this.name = name;
    }

    public String getName() {
        return name;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getEmail() {
        return email;
    }

    public boolean isValidEmail() {
        if (TextUtils.isEmpty(email)) {
            return false;
        }

        if (!email.contains("@")) {
            return false;
        }

        return true;
    }


    public void setPassword(String password) {
        this.password = password;
    }

    public String getPassword() {
        return password;
    }

    public boolean isValidPassword() {

        if (TextUtils.isEmpty(password)) {
            return false;
        }

        if (password.length() <= 4) {
            return false;
        }

        return true;
    }
}
