package com.riotech.easyspa;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.IdRes;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.view.View;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.TextView;

import com.riotech.easyspa.model.User;
import com.riotech.easyspa.util.Session;
import com.roughike.bottombar.BottomBar;
import com.roughike.bottombar.OnTabSelectListener;

public class AppActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    private Session session;
    private User user;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_app);
        session = new Session(this);
        user = new User();
        session.convertToUser(user);

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });

        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        View hView = navigationView.getHeaderView(0);

        TextView menu_nome = (TextView) hView.findViewById(R.id.menu_name);
        menu_nome.setText(user.getName());

        TextView menu_email = (TextView) hView.findViewById(R.id.menu_email);
        menu_email.setText(user.getEmail());

        BottomBar bottomBar = (BottomBar) findViewById(R.id.tabs_busca);
        bottomBar.setOnTabSelectListener(new OnTabSelectListener() {
            @Override
            public void onTabSelected(@IdRes int tabId) {
                //if (tabId == R.id.tab_favorites) {
                // The tab with id R.id.tab_favorites was selected,
                // change your content accordingly.
                // }
            }
        });
    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();

        FragmentManager manager = getSupportFragmentManager();
        FragmentTransaction transaction = manager.beginTransaction();

        if (id == R.id.action_embelezar) {
            EmbelezarFragment embelezarFragment = new EmbelezarFragment();
            transaction.replace(R.id.easyspa_content, embelezarFragment, embelezarFragment.getTag()).commit();
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        int id = item.getItemId();

        FragmentManager manager = getSupportFragmentManager();
        FragmentTransaction transaction = manager.beginTransaction();

        if (id == R.id.embelezar) {

            EmbelezarFragment embelezarFragment = new EmbelezarFragment();
            transaction.replace(R.id.easyspa_content, embelezarFragment, embelezarFragment.getTag()).commit();

        } else if (id == R.id.conversas) {

            ConversasFragment conversasFragment = new ConversasFragment();
            transaction.replace(R.id.easyspa_content, conversasFragment, conversasFragment.getTag()).commit();

        } else if (id == R.id.atendimentos) {

            AtendimentosFragment atendimentosFragment = new AtendimentosFragment();
            transaction.replace(R.id.easyspa_content, atendimentosFragment, atendimentosFragment.getTag()).commit();

        } else if (id == R.id.configuracoes) {

            ConfiguracoesFragment configuracoesFragment = new ConfiguracoesFragment();
            transaction.replace(R.id.easyspa_content, configuracoesFragment, configuracoesFragment.getTag()).commit();

        } else if (id == R.id.sair) {
            logout();
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    /**
     * Faz logout da aplicação easySpa
     */
    private void logout() {
        (new AlertDialog.Builder(this)
                .setTitle(getString(R.string.msg_confirm_exit_title))
                .setMessage(getString(R.string.msg_confirm_exit_message))
                .setIcon(R.drawable.ic_menu_5)

                .setPositiveButton(getString(android.R.string.yes), new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int whichButton) {
                        session.destroy();
                        Intent loginPage = new Intent(AppActivity.this, LoginActivity.class);
                        startActivity(loginPage);
                        dialog.dismiss();
                    }

                })

                .setNegativeButton(getString(android.R.string.no), new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.dismiss();
                    }
                })
        ).create().show();
    }
}
