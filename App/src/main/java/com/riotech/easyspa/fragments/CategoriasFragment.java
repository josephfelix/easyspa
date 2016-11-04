package com.riotech.easyspa.fragments;

import android.app.Activity;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import com.riotech.easyspa.R;
import com.riotech.easyspa.adapters.CategoriasAdapter;
import com.riotech.easyspa.model.Categoria;
import com.riotech.easyspa.util.Categorias;

import java.util.ArrayList;

public class CategoriasFragment extends Fragment {

    public View onCreateFragment(View rootView) {
        Categorias todasCategorias = new Categorias();
        Activity activity = getActivity();
        final ArrayList<Categoria> categorias = todasCategorias.get(activity);

        CategoriasAdapter categoriasAdapter = new CategoriasAdapter(activity, categorias);
        ListView listaCategorias = (ListView) rootView.findViewById(R.id.lista_categorias);
        listaCategorias.setAdapter(categoriasAdapter);
        listaCategorias.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int position, long l) {
                Categoria categoria = categorias.get(position);

                Toast.makeText(getContext(), "Categoria: " + categoria.getNome(), Toast.LENGTH_SHORT).show();
            }
        });

        return rootView;
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_categorias, container, false);
        return onCreateFragment(rootView);
    }

}
