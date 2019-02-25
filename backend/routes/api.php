<?php

// 驗證
Route::post("/auth/login", "AuthController@login");

// 產品

Route::get("/products/{id}/options", "ProductController@options");
Route::post("/products/{id}/options", "ProductController@addOption");
Route::patch("/products/{id}/options", "ProductController@patchOption");
Route::delete("/products/{id}/options", "ProductController@deleteOption");

Route::get("/products", "ProductController@paginated");
Route::get("/products/all", "ProductController@all");
Route::post("/products", "ProductController@store");
Route::get("/products/{id}", "ProductController@item");
Route::delete("/products/{id}", "ProductController@delete");
Route::patch("/products/{id}", "ProductController@patch");

Route::get("/currencies", "TestController@currencies");
