package com.riotech.easyspa.location;

import android.app.AlertDialog.Builder;
import android.app.Service;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.os.IBinder;
import android.provider.Settings;

import com.riotech.easyspa.R;

/**
 * Class EasySpaGPS
 */
public class EasySpaGPS extends Service implements LocationListener {
    private Context context;
    public boolean isGPSEnabled = false;
    public boolean isNetworkEnabled = false;
    public boolean canGetLocation = false;

    Location location;

    double latitude = 0;
    double longitude = 0;

    private static final long MIN_DISTANCE_CHANGE_FOR_UPDATES = 10;
    private static final long MIN_TIME_BW_UPDATES = 1000 * 60 * 1;

    protected LocationManager locationManager;
    private EasySpaLocationCallback successCallback = null;
    private EasySpaLocationCallback errorCallback = null;

    /**
     * EasySpaGPS Constructor
     *
     * @param context
     */
    public EasySpaGPS(Context context) {
        this.context = context;
    }

    /**
     * Busca a localização do usuário
     *
     * @return
     */
    public Location getLocation() {
        try {
            locationManager = (LocationManager) context.getSystemService(LOCATION_SERVICE);
            isGPSEnabled = locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER);
            isNetworkEnabled = locationManager.isProviderEnabled(LocationManager.NETWORK_PROVIDER);

            if (!isGPSEnabled && !isNetworkEnabled) {
                showSettingsAlert();
            } else {
                this.canGetLocation = true;
                if (isNetworkEnabled) {

                    locationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, MIN_TIME_BW_UPDATES, MIN_DISTANCE_CHANGE_FOR_UPDATES, this);

                    if (locationManager != null) {
                        location = locationManager.getLastKnownLocation(LocationManager.NETWORK_PROVIDER);

                        if (location != null) {
                            latitude = location.getLatitude();
                            longitude = location.getLongitude();
                        }
                    }
                }

                if (isGPSEnabled) {
                    if (location == null) {
                        locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, MIN_TIME_BW_UPDATES, MIN_DISTANCE_CHANGE_FOR_UPDATES, this);

                        if (locationManager != null) {
                            location = locationManager.getLastKnownLocation(LocationManager.GPS_PROVIDER);

                            if (location != null) {
                                latitude = location.getLatitude();
                                longitude = location.getLongitude();
                            }

                        }

                    }
                }

                if (isGPSEnabled || isNetworkEnabled) {
                    if ((latitude > 0 || latitude < 0) && (longitude > 0 || longitude < 0)) {
                        successCallback.run();
                    } else {
                        errorCallback.run();
                    }
                } else {
                    errorCallback.run();
                }


            }

        } catch (SecurityException e) {
            e.printStackTrace();
        }

        return location;
    }

    public void stopUsingGPS() throws SecurityException {
        if (locationManager != null) {
            locationManager.removeUpdates(EasySpaGPS.this);
        }
    }

    public double getLatitude() {
        if (location != null) {
            latitude = location.getLatitude();
        }
        return latitude;
    }

    public double getLongitude() {
        if (location != null) {
            longitude = location.getLongitude();
        }
        return longitude;

    }

    public void setSuccessCallback(EasySpaLocationCallback successCallback) {
        this.successCallback = successCallback;
    }

    public EasySpaLocationCallback getSuccessCallback() {
        return successCallback;
    }

    public void setErrorCallback(EasySpaLocationCallback errorCallback) {
        this.errorCallback = errorCallback;
    }

    public EasySpaLocationCallback getErrorCallback() {
        return errorCallback;
    }

    public boolean canGetLocation() {
        return this.canGetLocation;
    }

    public void showSettingsAlert() {
        Builder alertDialog = new Builder(context);
        alertDialog.setTitle(R.string.locationDialogTitle);
        alertDialog.setMessage(R.string.locationDialogMessage);
        alertDialog.setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {

            @Override
            public void onClick(DialogInterface dialog, int which) {
                Intent intent = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
                context.startActivity(intent);
            }
        });

        alertDialog.setNegativeButton(android.R.string.no, new DialogInterface.OnClickListener() {

            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.cancel();
                errorCallback.run();
            }
        });
        alertDialog.show();
    }


    @Override
    public void onLocationChanged(Location location) {
        // TODO Auto-generated method stub

    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {
        // TODO Auto-generated method stub

    }

    @Override
    public void onProviderEnabled(String provider) {
        // TODO Auto-generated method stub

    }

    @Override
    public void onProviderDisabled(String provider) {
        // TODO Auto-generated method stub

    }

    @Override
    public IBinder onBind(Intent intent) {
        // TODO Auto-generated method stub
        return null;
    }
}