package com.cristiangonzalez.renapapp.activities

import android.content.Intent
import android.os.Bundle
import android.view.View
import androidx.appcompat.app.AppCompatActivity
import com.cristiangonzalez.renapapp.R
import com.cristiangonzalez.renapapp.interfaces.*
import com.cristiangonzalez.renapapp.models.Person
import com.cristiangonzalez.renapapp.utils.*
import kotlinx.android.synthetic.main.activity_login.*
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory

class LoginActivity : AppCompatActivity() {

    lateinit var people: List<Person>
    private lateinit var retrofit: Retrofit
    private lateinit var apiService: ApiService

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)

        loginProgressBar.bringToFront() //Traer al frente barra de progreso
        //Obtener correo y contraseña ingresados
        buttonLogIn.setOnClickListener {
            val email = editTextEmail.text.toString()
            val password = editTextPassword.text.toString()
            //Validar correo y contraseña
            if (isValidEmail(email) && isValidPassword(password)) {
                findPerson(email, password)
            } else {
                toast(R.string.login_incorrect_data)
            }
        }
        //Validar correo en tiempo real
        editTextEmail.validate {
            textInputEmail.error = if (isValidEmail(it)) null else getString(R.string.login_invalid_email)
        }
        //Validar contraseña en tiempo real
        editTextPassword.validate {
            textInputPassword.error = if (isValidPassword(it)) null else getString(R.string.login_invalid_password)
        }
    }

    private fun onLoginClickListener(person: Person) {
        val intent = Intent(this, MainActivity::class.java)
        //Enviar datos de persona
        intent.putExtra(getString(R.string.main_cui), person.cui)
        intent.putExtra(getString(R.string.main_name), person.name)
        intent.putExtra(getString(R.string.main_last_name), person.last_name)
        intent.putExtra(getString(R.string.main_address), person.address)
        intent.putExtra(getString(R.string.main_department), person.department)
        intent.putExtra(getString(R.string.main_township), person.township)
        intent.putExtra(getString(R.string.main_status), person.status)
        startActivity(intent)
    }

    private fun findPerson(email: String, password: String) {
        showProgressBar()
        //Conectar a api
        retrofit = Retrofit.Builder().baseUrl(ApiService.URL)
                    .addConverterFactory(GsonConverterFactory.create()).build()
        //Crear interface
        apiService = retrofit.create(ApiService::class.java)
        //Obtener personas
        apiService.getPeople().enqueue(object : Callback<List<Person>> {

            override fun onResponse(call: Call<List<Person>>?, response: Response<List<Person>>?) {
                //Validar
                if (response != null) {
                    if (response.isSuccessful) {
                        people = response.body() as List<Person> //Obtener lista de personas
                        //Encontrar persona con correo y contraseña
                        var emailExists = false
                        for (person in people) {
                            //Validar correo
                            if (person.email == email) {
                                emailExists = true
                                //Validar contraseña
                                if (person.password == password) {
                                    //Si existe, pasar datos
                                    onLoginClickListener(person)
                                } else {
                                    hideProgressBar()
                                    //Si no, mostrar mensaje
                                    toast(R.string.login_password_not_found)
                                }
                            }
                        }
                        if (!emailExists) {
                            hideProgressBar()
                            toast(R.string.login_email_not_found)
                        }
                    }
                }
            }

            override fun onFailure(call: Call<List<Person>>?, t: Throwable?) {
                hideProgressBar()
                if (t != null) {
                    toast(R.string.login_unexpected_error)
                }
            }
        })
    }

    private fun showProgressBar() {
        loginProgressBar.visibility = View.VISIBLE //Mostrar barra de progreso
    }

    private fun hideProgressBar() {
        loginProgressBar.visibility = View.GONE //Ocultar barra de progreso
    }

}