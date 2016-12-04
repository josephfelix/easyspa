package com.riotech.easyspa.permission;

import android.Manifest;
import android.content.Context;
import android.content.pm.PackageManager;
import android.os.Build;
import android.support.annotation.NonNull;
import android.support.v4.app.ActivityCompat;

import com.riotech.easyspa.LoginActivity;

/**
 * Class EasySpaLocationPermission
 */
public class EasySpaLocationPermission {
    /**
     * Código de requisição para localização
     */
    public static final int REQUEST_LOCATION = 0;


    private LoginActivity activity;
    private EasySpaPermissionCallback callback;

    private boolean granted = false;

    /**
     * Busca a activity que está sendo usada para buscar permissão
     * @return LoginActivity
     */
    public LoginActivity getActivity() {
        return activity;
    }

    /**
     * Altera a activity usada para solicitar permissão
     * @param activity Activity
     */
    public void setActivity(LoginActivity activity) {
        this.activity = activity;
    }

    /**
     * Método assincrono que anexa um callback ao usuário
     * aceitar ou negar a permissão de localização
     * @param callback Instância de EasySpaPermissionCallback com o método de callback
     */
    public void onRequest(EasySpaPermissionCallback callback) {
        this.callback = callback;

        // Se a API Level do Android for inferior ao Marshmallow
        if (Build.VERSION.SDK_INT < 23) {
            callback.onGranted();
        } else {

            // Busca o contexto da aplicação pela activity
            Context context = this.getActivity().getApplicationContext();

            // Busca as duas solicitações permissões de localização
            int permissionFineLocation = ActivityCompat.checkSelfPermission(context, Manifest.permission.ACCESS_FINE_LOCATION);
            int permissionCoarseLocation = ActivityCompat.checkSelfPermission(context, Manifest.permission.ACCESS_COARSE_LOCATION);

            // Verifica se as solicitações de permissões estão aprovadas
            if (permissionFineLocation == PackageManager.PERMISSION_GRANTED &&
                    permissionCoarseLocation == PackageManager.PERMISSION_GRANTED) {

                granted = true;

                // Se aprovada, vai para o método de aprovação
                callback.onGranted();

            } else {

                // Caso contrário, cria um vetor com as permissões necessárias
                String[] permissions = new String[]{Manifest.permission.ACCESS_FINE_LOCATION, Manifest.permission.ACCESS_COARSE_LOCATION};

                // Solicita ao usuário as permissões
                ActivityCompat.requestPermissions(this.getActivity(), permissions, REQUEST_LOCATION);

            }
        }
    }

    /**
     * Processa o código de solicitação de permissão que o LoginActivity recebe
     *
     * @param requestCode Código de permissão
     * @param permissions Permissões solicitadas
     * @param grantResults Resultados retornados
     */
    public void processRequestCode(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {

        // Se o código for o de localização
        if (requestCode == REQUEST_LOCATION) {

            // Se o usuário tiver permitido
            if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {

                granted = true;

                // Executa o onGranted
                this.callback.onGranted();
            } else {

                // Caso contrário, executa o onDenied
                this.callback.onDenied();
            }
        }
    }

    public boolean isGranted() {
        return granted;
    }


    public boolean onDenied() {
        return !granted;
    }
}
