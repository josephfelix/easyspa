package com.riotech.easyspa.location;

import android.content.Context;
import android.location.Address;
import android.location.Geocoder;

import java.io.IOException;
import java.util.List;

public class EasySpaGeoCoder {
    public static final int MAX_RESULTS = 1;

    public static String translateLocation(Context context, double latitude, double longitude) {
        Geocoder geocoder = new Geocoder(context);
        Address endereco = null;
        String localidade = "";

        try {

            List<Address> addresses = geocoder.getFromLocation(latitude, longitude, MAX_RESULTS);
            endereco = addresses.get(0);
        } catch (IOException e) {
            e.printStackTrace();
        }

        if (endereco != null) {
            localidade = endereco.getSubLocality();
            if (localidade.length() == 0) {
                localidade = endereco.getLocality();
            }
        }

        return localidade;
    }
}
