package com.riotech.easyspa.model;

public class User {
    private String uniqueID;
    private String firstname;
    private String lastname;
    private String email;
    private int loginMethod;
    private int status;


    public String getUniqueID() {
        return uniqueID;
    }

    public void setUniqueID(String uniqueID) {
        this.uniqueID = uniqueID;
    }

    public void setFirstname(String firstname) {
        this.firstname = firstname;
    }

    public String getFirstname() {
        return firstname;
    }

    public void setLastname(String lastname) {
        this.lastname = lastname;
    }

    public String getLastname() {
        return lastname;
    }

    public String getFullName() {
        return firstname + " " + lastname;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getEmail() {
        return email;
    }

    public int getStatus() {
        return status;
    }

    public void setStatus(int status) {
        this.status = status;
    }

    public int getLoginMethod() {
        return loginMethod;
    }

    public void setLoginMethod(int loginMethod) {
        this.loginMethod = loginMethod;
    }
}
