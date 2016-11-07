package com.riotech.easyspa.fragments;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

import com.riotech.easyspa.R;
import com.riotech.easyspa.util.Categorias;

public class InicioFragment extends Fragment {

    public View onCreateFragment(View rootView) {

        // Pés e mãos
        Button pes_e_maos = (Button) rootView.findViewById(R.id.pes_e_maos);
        pes_e_maos.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showMapFragment(Categorias.ID_CAT_PES_E_MAOS, getString(R.string.categoria_1));
            }
        });

        // Cabeleireiro
        Button cabeleireiro = (Button) rootView.findViewById(R.id.cabeleireiro);
        cabeleireiro.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showMapFragment(Categorias.ID_CAT_CABELEIREIRO, getString(R.string.categoria_4));
            }
        });

        // Depilação
        Button depilacao = (Button) rootView.findViewById(R.id.depilacao);
        depilacao.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showMapFragment(Categorias.ID_CAT_DEPILACAO, getString(R.string.categoria_8));
            }
        });

        // Sombrancelha
        Button sombrancelha = (Button) rootView.findViewById(R.id.sombrancelha);
        sombrancelha.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showMapFragment(Categorias.ID_CAT_DESIGN_DE_SOBRANCELHAS, getString(R.string.categoria_9));
            }
        });

        // Maquiagem
        Button maquiagem = (Button) rootView.findViewById(R.id.maquiagem);
        maquiagem.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showMapFragment(Categorias.ID_CAT_MAQUIAGEM, getString(R.string.categoria_14));
            }
        });

        // Estética corporal
        Button estetica_corporal = (Button) rootView.findViewById(R.id.estetica_corporal);
        estetica_corporal.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showMapFragment(Categorias.ID_CAT_ESTETICA_CORPORAL, getString(R.string.categoria_10));
            }
        });

        // Estética facial
        Button estetica_facial = (Button) rootView.findViewById(R.id.estetica_facial);
        estetica_facial.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showMapFragment(Categorias.ID_CAT_ESTETICA_FACIAL, getString(R.string.categoria_11));
            }
        });

        // Mais categorias
        Button maisCategorias = (Button) rootView.findViewById(R.id.mais_categorias);
        maisCategorias.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                FragmentManager manager = getFragmentManager();
                CategoriasFragment categoriasFragment = new CategoriasFragment();
                FragmentTransaction transaction = manager.beginTransaction();
                transaction
                        .replace(R.id.easyspa_content, categoriasFragment, categoriasFragment.getTag())
                        .addToBackStack(getTag())
                        .commit();
            }
        });


        return rootView;
    }

    /**
     * Exibe o MapaFragment
     *
     * @param idcategoria   Id da categoria
     * @param nomecategoria Nome da categoria
     */
    private void showMapFragment(int idcategoria, String nomecategoria) {
        FragmentManager manager = getFragmentManager();
        FragmentTransaction transaction = manager.beginTransaction();
        MapaFragment mapaFragment = MapaFragment.createInstance(idcategoria, nomecategoria);
        transaction
                .replace(R.id.easyspa_content, mapaFragment, mapaFragment.getTag())
                .addToBackStack(getTag())
                .commit();
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_inicio, container, false);
        return onCreateFragment(rootView);
    }

}
