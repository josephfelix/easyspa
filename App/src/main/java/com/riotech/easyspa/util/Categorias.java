package com.riotech.easyspa.util;

import android.app.Activity;

import com.riotech.easyspa.R;
import com.riotech.easyspa.model.Categoria;

import java.util.ArrayList;

public class Categorias {
    public final int ID_CAT_PES_E_MAOS = 1;
    public final int ID_CAT_ACADEMIAS = 2;
    public final int ID_CAT_ACUPUNTURA = 3;
    public final int ID_CAT_CABELEIREIRO = 4;
    public final int ID_CAT_CILIOS = 5;
    public final int ID_CAT_CLINICA_ESTETICA = 6;
    public final int ID_CAT_DENTISTA = 7;
    public final int ID_CAT_DEPILACAO = 8;
    public final int ID_CAT_DESIGN_DE_SOBRANCELHAS = 9;
    public final int ID_CAT_ESTETICA_CORPORAL = 10;
    public final int ID_CAT_ESTETICA_FACIAL = 11;
    public final int ID_CAT_FISIOTERAPIA = 12;
    public final int ID_CAT_HIDROTERAPIA = 13;
    public final int ID_CAT_MAQUIAGEM = 14;
    public final int ID_CAT_MASSAGEM = 15;
    public final int ID_CAT_NUTRICIONISTA = 16;
    public final int ID_CAT_PERSONAL_TRAINER = 17;
    public final int ID_CAT_PIERCING = 18;
    public final int ID_CAT_PRATICAS_INTEGRATIVAS = 19;
    public final int ID_CAT_SALAO_DE_BELEZA = 20;
    public final int ID_CAT_SPA = 21;
    public final int ID_CAT_YOGA = 22;

    private ArrayList<Categoria> categorias = new ArrayList<Categoria>();

    public ArrayList<Categoria> get(Activity activity) {
        categorias.add(new Categoria(ID_CAT_PES_E_MAOS, activity.getString(R.string.categoria_1), "Descrição da categoria", R.drawable.icon_pesmaos));
        categorias.add(new Categoria(ID_CAT_ACADEMIAS, activity.getString(R.string.categoria_2), "Descrição da categoria", R.drawable.icon_academias));
        categorias.add(new Categoria(ID_CAT_ACUPUNTURA, activity.getString(R.string.categoria_3), "Descrição da categoria", R.drawable.icon_acupuntura));
        categorias.add(new Categoria(ID_CAT_CABELEIREIRO, activity.getString(R.string.categoria_4), "Descrição da categoria", R.drawable.icon_cabelereiro));
        categorias.add(new Categoria(ID_CAT_CILIOS, activity.getString(R.string.categoria_5), "Descrição da categoria", R.drawable.icon_cilios));
        categorias.add(new Categoria(ID_CAT_CLINICA_ESTETICA, activity.getString(R.string.categoria_6), "Descrição da categoria", R.drawable.icon_clinicaestetica));
        categorias.add(new Categoria(ID_CAT_DENTISTA, activity.getString(R.string.categoria_7), "Descrição da categoria", R.drawable.icon_dentista));
        categorias.add(new Categoria(ID_CAT_DEPILACAO, activity.getString(R.string.categoria_8), "Descrição da categoria", R.drawable.icon_depilacao));
        categorias.add(new Categoria(ID_CAT_DESIGN_DE_SOBRANCELHAS, activity.getString(R.string.categoria_9), "Descrição da categoria", R.drawable.icon_designsobrancelha));
        categorias.add(new Categoria(ID_CAT_ESTETICA_CORPORAL, activity.getString(R.string.categoria_10), "Descrição da categoria", R.drawable.icon_esteticacorporal));
        categorias.add(new Categoria(ID_CAT_ESTETICA_FACIAL, activity.getString(R.string.categoria_11), "Descrição da categoria", R.drawable.icon_esteticafacial));
        categorias.add(new Categoria(ID_CAT_FISIOTERAPIA, activity.getString(R.string.categoria_12), "Descrição da categoria", R.drawable.icon_fisioterapia));
        categorias.add(new Categoria(ID_CAT_HIDROTERAPIA, activity.getString(R.string.categoria_13), "Descrição da categoria", R.drawable.icon_hidroterapia));
        categorias.add(new Categoria(ID_CAT_MAQUIAGEM, activity.getString(R.string.categoria_14), "Descrição da categoria", R.drawable.icon_maquiagem));
        categorias.add(new Categoria(ID_CAT_MASSAGEM, activity.getString(R.string.categoria_15), "Descrição da categoria", R.drawable.icon_massagem));
        categorias.add(new Categoria(ID_CAT_NUTRICIONISTA, activity.getString(R.string.categoria_16), "Descrição da categoria", R.drawable.icon_nutricionista));
        categorias.add(new Categoria(ID_CAT_PERSONAL_TRAINER, activity.getString(R.string.categoria_17), "Descrição da categoria", R.drawable.icon_personaltrainer));
        categorias.add(new Categoria(ID_CAT_PIERCING, activity.getString(R.string.categoria_18), "Descrição da categoria", R.drawable.icon_piercing));
        categorias.add(new Categoria(ID_CAT_PRATICAS_INTEGRATIVAS, activity.getString(R.string.categoria_19), "Descrição da categoria", R.drawable.icon_praticasintegrativas));
        categorias.add(new Categoria(ID_CAT_SALAO_DE_BELEZA, activity.getString(R.string.categoria_20), "Descrição da categoria", R.drawable.icon_salaobeleza));
        categorias.add(new Categoria(ID_CAT_SPA, activity.getString(R.string.categoria_21), "Descrição da categoria", R.drawable.icon_spa));
        categorias.add(new Categoria(ID_CAT_YOGA, activity.getString(R.string.categoria_22), "Descrição da categoria", R.drawable.icon_yoga));
        return categorias;
    }
}
