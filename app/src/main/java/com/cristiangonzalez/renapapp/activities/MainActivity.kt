package com.cristiangonzalez.renapapp.activities

import android.content.Intent
import android.os.Bundle
import android.view.Menu
import android.view.MenuItem
import androidx.appcompat.app.AppCompatActivity
import com.cristiangonzalez.renapapp.R
import com.cristiangonzalez.renapapp.utils.goToActivity
import com.google.android.material.dialog.MaterialAlertDialogBuilder
import kotlinx.android.synthetic.main.activity_main.*

class MainActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        //Incluir toolbar
        setSupportActionBar(mainToolbar)
        //Obtener datos de persona
        var status = ""
        val dpi = "DPI: " + intent.getStringExtra(getString(R.string.main_cui))
        val name = "Nombre: " + intent.getStringExtra(getString(R.string.main_name)) + " " + intent.getStringExtra(getString(R.string.main_last_name))
        val address = "Dirección: " + intent.getStringExtra(getString(R.string.main_address))
        val department = "Ubicación: " + intent.getStringExtra(getString(R.string.main_township)) + " " + intent.getStringExtra(getString(R.string.main_department))
        //Traducir
        when (intent.getStringExtra(getString(R.string.main_status))) {
            "requested" -> {
                status = "Solicitado"
            }
            "process" -> {
                status = "En Proceso"
            }
            "deliver" -> {
                status = "Listo para Entregar"
            }
        }
        //Insertar datos en cajas de texto
        textViewStatus.text = status
        textViewCui.text = dpi
        textViewName.text = name
        textViewAddress.text = address
        textViewDepartment.text = department
    }

    override fun onCreateOptionsMenu(menu: Menu): Boolean {
        menuInflater.inflate(R.menu.menu_activity_main, menu) //Agregar opción de cerrar sesión
        return super.onCreateOptionsMenu(menu)
    }

    override fun onOptionsItemSelected(item: MenuItem): Boolean {
        when (item.itemId) {
            R.id.menu_log_out -> {
                showDialog() //Cerrar sesión
            }
        }
        return super.onOptionsItemSelected(item)
    }

    private fun showDialog() {
        //Diálogo para cerrar sesión
        MaterialAlertDialogBuilder(this)
            .setTitle(resources.getString(R.string.logout_dialog_title))
            .setMessage(resources.getString(R.string.logout_dialog_message))
            .setNegativeButton(resources.getString(R.string.logout_dialog_negative)) { _, _ -> }
            .setPositiveButton(resources.getString(R.string.logout_dialog_positive)) { _, _ ->
                goToActivity<LoginActivity> {
                    flags = Intent.FLAG_ACTIVITY_NEW_TASK or Intent.FLAG_ACTIVITY_CLEAR_TASK
                }
            }
            .show()
    }

}