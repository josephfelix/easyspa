package com.riotech.easyspa;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.NonNull;
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

import com.facebook.login.LoginManager;
import com.riotech.easyspa.fragments.AgendaFragment;
import com.riotech.easyspa.fragments.ConfiguracoesFragment;
import com.riotech.easyspa.fragments.ConversasFragment;
import com.riotech.easyspa.fragments.HistoricoFragment;
import com.riotech.easyspa.fragments.InicioFragment;
import com.riotech.easyspa.model.User;
import com.riotech.easyspa.util.Session;

public class AppActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    private Session session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_app);
        session = new Session(this);
        User user = session.getUser();

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
        menu_nome.setText(user.getFullName());

        TextView menu_email = (TextView) hView.findViewById(R.id.menu_email);
        menu_email.setText(user.getEmail());

        FragmentManager manager = getSupportFragmentManager();
        FragmentTransaction transaction = manager.beginTransaction();

        InicioFragment inicioFragment = new InicioFragment();
        transaction.replace(R.id.easyspa_content, inicioFragment, inicioFragment.getTag()).commit();

       /* BottomBar bottomBar = (BottomBar) findViewById(R.id.tabs_busca);
        bottomBar.setOnTabSelectListener(new OnTabSelectListener() {
            @Override
            public void onTabSelected(@IdRes int tabId) {
                //if (tabId == R.id.tab_favorites) {
                // The tab with id R.id.tab_favorites was selected,
                // change your content accordingly.
                // }
            }
        });*/
    }

    @Override
    public void onBackPressed() {

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else if (getFragmentManager().getBackStackEntryCount() != 0) {
            getFragmentManager().popBackStack();
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
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        int id = item.getItemId();

        FragmentManager manager = getSupportFragmentManager();
        FragmentTransaction transaction = manager.beginTransaction();

        InicioFragment inicioFragment = new InicioFragment();

        if (id == R.id.embelezar) {

            transaction
                    .replace(R.id.easyspa_content, inicioFragment, inicioFragment.getTag())
                    .addToBackStack(inicioFragment.getTag())
                    .commit();

        } else if (id == R.id.conversas) {

            ConversasFragment conversasFragment = new ConversasFragment();
            transaction
                    .replace(R.id.easyspa_content, conversasFragment, conversasFragment.getTag())
                    .addToBackStack(inicioFragment.getTag())
                    .commit();

        } else if (id == R.id.agenda) {

            AgendaFragment agendaFragment = new AgendaFragment();
            transaction
                    .replace(R.id.easyspa_content, agendaFragment, agendaFragment.getTag())
                    .addToBackStack(inicioFragment.getTag())
                    .commit();

        } else if (id == R.id.historico) {

            HistoricoFragment historicoFragment = new HistoricoFragment();
            transaction
                    .replace(R.id.easyspa_content, historicoFragment, historicoFragment.getTag())
                    .addToBackStack(inicioFragment.getTag())
                    .commit();

        } else if (id == R.id.configuracoes) {

            ConfiguracoesFragment configuracoesFragment = new ConfiguracoesFragment();
            transaction
                    .replace(R.id.easyspa_content, configuracoesFragment, configuracoesFragment.getTag())
                    .addToBackStack(inicioFragment.getTag())
                    .commit();

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
                .setIcon(R.drawable.ic_menu_6)

                .setPositiveButton(getString(android.R.string.yes), new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int whichButton) {

                        // Mata a sessão atual
                        session.destroy();

                        // Faz logout do facebook
                        LoginManager.getInstance().logOut();

                        // Redireciona para a activity de login
                        Intent loginPage = new Intent(AppActivity.this, LoginActivity.class);
                        startActivity(loginPage);

                        // Fecha o diálogo
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
