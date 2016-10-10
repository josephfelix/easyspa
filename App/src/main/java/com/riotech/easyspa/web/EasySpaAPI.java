package com.riotech.easyspa.web;

import com.riotech.easyspa.model.User;
import com.riotech.easyspa.model.UserStatus;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.Path;
import retrofit2.http.Query;

public interface EasySpaAPI {

    // user/facebook
    @FormUrlEncoded
    @POST("login.json")
    Call<UserStatus> loginFacebook(@Field("uniqueid") String uniqueid, @Field("email") String email);

    // user/google
    @FormUrlEncoded
    @POST("login.json")
    Call<UserStatus> loginGoogle(@Field("uniqueid") String uniqueid, @Field("email") String email);
}