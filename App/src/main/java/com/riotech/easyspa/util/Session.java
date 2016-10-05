package com.riotech.easyspa.util;

import android.content.Context;
import android.content.SharedPreferences;

import com.riotech.easyspa.model.User;

public class Session {
    public final int LOGOUT = 0;
    public final int LOGIN = 1;
    private SharedPreferences session;

    public Session(Context context) {
        session = context.getSharedPreferences("EASYSPA", Context.MODE_PRIVATE);
    }

    public void set(String key, String data) {
        SharedPreferences.Editor editor = session.edit();
        editor.putString(key, data);
        editor.commit();
    }

    public void set(String key, int data) {
        SharedPreferences.Editor editor = session.edit();
        editor.putInt(key, data);
        editor.commit();
    }

    public void destroy() {
        SharedPreferences.Editor editor = session.edit();
        editor.clear();
        editor.commit();
    }

    public String getString(String key) {
        return session.getString(key, "");
    }

    public int getInt(String key) {
        return session.getInt(key, 0);
    }

    public boolean isLoggedIn() {
        return getInt("logged") == LOGIN;
    }

    public void convertToUser(User user) {
        user.setName(this.getString("name"));
        user.setEmail(this.getString("email"));
    }
}
