package com.cristiangonzalez.renapapp.utils

import android.app.Activity
import android.content.Intent
import android.text.Editable
import android.text.TextWatcher
import android.util.Patterns
import android.widget.Toast
import com.google.android.material.textfield.TextInputEditText
import java.util.regex.Pattern

//Toast con recurso string
fun Activity.toast(resourceId: Int, duration: Int = Toast.LENGTH_SHORT) = Toast.makeText(this, resourceId, duration).show()

//Iniciar activity
inline fun <reified T : Activity> Activity.goToActivity(noinline init: Intent.() -> Unit = {}) {
    val intent = Intent(this, T::class.java)
    intent.init()
    startActivity(intent)
}

//Validar en tiempo real
fun TextInputEditText.validate(validation: (String) -> Unit) {
    this.addTextChangedListener(object : TextWatcher {
        override fun afterTextChanged(editable: Editable) {
            validation(editable.toString())
        }

        override fun beforeTextChanged(s: CharSequence?, start: Int, count: Int, after: Int) {}

        override fun onTextChanged(s: CharSequence?, start: Int, before: Int, count: Int) {}

    })
}

fun isValidEmail(email: String): Boolean {
    val pattern = Patterns.EMAIL_ADDRESS //Validar correo con pattern

    return pattern.matcher(email).matches()
}

fun isValidPassword(password: String): Boolean {
    val passwordPattern = "^.{8,}\$" //Validar contraseña con pattern
    val pattern = Pattern.compile(passwordPattern)

    return pattern.matcher(password).matches()
}