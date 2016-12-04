package com.riotech.easyspa.fragments;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import com.riotech.easyspa.R;

import java.util.Arrays;
import java.util.List;

public class LocalidadeFragment extends Fragment {

    public View onInit(View rootView) {

        List<String> bairros = Arrays.asList("Maria da graça", "Cachambi", "Higienópolis", "Jacarézinho");
        ArrayAdapter<String> adapter = new ArrayAdapter<>(this.getActivity(), android.R.layout.simple_list_item_1, bairros);
        ListView lista = (ListView) rootView.findViewById(R.id.lista_bairros);
        lista.setAdapter(adapter);

        return rootView;
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_localidade, container, false);
        return onInit(rootView);
    }
}
