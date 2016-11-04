package com.riotech.easyspa.adapters;

import android.app.Activity;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.riotech.easyspa.R;
import com.riotech.easyspa.model.Categoria;

import java.util.List;

public class CategoriasAdapter extends BaseAdapter {

    private List<Categoria> categorias;
    private Activity activity;

    public CategoriasAdapter(Activity activity, List<Categoria> categorias) {
        this.activity = activity;
        this.categorias = categorias;
    }

    @Override
    public int getCount() {
        return categorias.size();
    }

    @Override
    public Object getItem(int item) {
        return categorias.get(item);
    }

    @Override
    public long getItemId(int item) {
        return categorias.get(item).getId();
    }

    @Override
    public View getView(int item, View v, ViewGroup viewGroup) {
        View view = this.activity.getLayoutInflater().inflate(R.layout.item_categoria, null);

        Categoria categoria = categorias.get(item);

        ImageView foto = (ImageView) view.findViewById(R.id.foto);
        int fotoCategoria = categoria.getFoto();

        if (fotoCategoria != 0) {
            Bitmap bm = BitmapFactory.decodeResource(activity.getResources(), fotoCategoria);
            bm = bm.createScaledBitmap(bm, 80, 80, true);
            foto.setImageBitmap(bm);
        }

        TextView nome = (TextView) view.findViewById(R.id.nome);
        nome.setText(categoria.getNome());

        TextView descricao = (TextView) view.findViewById(R.id.descricao);
        descricao.setText(categoria.getDescricao());

        return view;
    }
}
