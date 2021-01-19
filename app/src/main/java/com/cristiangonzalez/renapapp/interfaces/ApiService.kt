package com.cristiangonzalez.renapapp.interfaces

import com.cristiangonzalez.renapapp.models.Person
import retrofit2.Call
import retrofit2.http.GET

interface ApiService {
    companion object {
        const val URL = "http://192.168.1.3:8000" //Ruta de proyecto
    }

    @GET("api/people") //Ruta de api
    fun getPeople(): Call<List<Person>> //Obtener lista con personas
}