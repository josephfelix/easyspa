package com.riotech.easyspa.fragments;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.riotech.easyspa.R;

public class MapaFragment extends Fragment implements OnMapReadyCallback {
    private static final String ARG_CATEGORIA_ID = "id";
    private static final String ARG_CATEGORIA_NOME = "nome";
    private int idcategoria = 0;
    private String nomecategoria = "";
    private GoogleMap mMap;

    /**
     * Factory para criar a instância do MapaFragment
     *
     * @param idcategoria
     * @param nomecategoria
     * @return MapaFragment
     */
    public static MapaFragment createInstance(int idcategoria, String nomecategoria) {
        MapaFragment fragment = new MapaFragment();
        Bundle args = new Bundle();
        args.putInt(ARG_CATEGORIA_ID, idcategoria);
        args.putString(ARG_CATEGORIA_NOME, nomecategoria);
        fragment.setArguments(args);
        return fragment;
    }

    /**
     * Executa ao inicializar o MapaFragment
     *
     * @param rootView
     * @return
     */
    protected View onInit(View rootView) {
        SupportMapFragment mapFragment = (SupportMapFragment) getChildFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);

        return rootView;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            idcategoria = getArguments().getInt(ARG_CATEGORIA_ID);
            nomecategoria = getArguments().getString(ARG_CATEGORIA_NOME);
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_mapa, container, false);
        return onInit(rootView);
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        LatLng sydney = new LatLng(-34, 151);
        mMap.addMarker(new MarkerOptions().position(sydney).title("Marker in Sydney"));
        mMap.moveCamera(CameraUpdateFactory.newLatLng(sydney));
    }
}
