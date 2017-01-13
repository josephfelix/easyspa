package com.riotech.easyspa.model;

import com.google.gson.annotations.SerializedName;

public class UserStatus {
    public static final int LOGIN_SUCCESS = 1;
    public static final int INVALID_USER = 2;

    @SerializedName("status")
    private int status;

    public int getStatus() {
        return status;
    }

    public void setStatus(int status) {
        this.status = status;
    }
}
