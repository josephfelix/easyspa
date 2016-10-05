package com.riotech.easyspa.web;

import com.riotech.easyspa.model.User;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.Path;
import retrofit2.http.Query;

public interface EasySpaAPI {

    // user/login
    @FormUrlEncoded
    @POST("login.json")
    Call<User> login(@Field("email") String email, @Field("password") String password);
}