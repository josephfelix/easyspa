package com.riotech.easyspa.model;

public class Categoria {
    private int id;
    private String nome;
    private String descricao;
    private int foto = 0;

    public Categoria(int id, String nome, String descricao, int foto) {
        this.id = id;
        this.nome = nome;
        this.descricao = descricao;
        this.foto = foto;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public void setFoto(int foto) {
        this.foto = foto;
    }

    public int getFoto() {
        return foto;
    }

    @Override
    public String toString() {
        return getId() + " - " + getNome();
    }
}
