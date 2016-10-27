package com.riotech.easyspa.fragments;


import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.Toast;

import com.riotech.easyspa.R;


/**
 * A simple {@link Fragment} subclass.
 */
public class InicioFragment extends Fragment {


    public InicioFragment() {

    }

    protected View attachButtonEvents(View rootView) {
        final FragmentManager manager = getFragmentManager();

        Button pes_e_maos = (Button) rootView.findViewById(R.id.pes_e_maos);
        pes_e_maos.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(getActivity(), "Pes e maos", Toast.LENGTH_SHORT).show();
            }
        });

        Button maisCategorias = (Button) rootView.findViewById(R.id.mais_categorias);
        maisCategorias.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
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

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_inicio, container, false);
        return attachButtonEvents(rootView);
    }

}
