<?php


/**
 * @OA\Info(title="MyUniBlog Website", version="0.1", @OA\Contact(email="benjamin.peljto@stu.ibu.edu.ba", name="Benjamin Peljto"))
 * @OA\OpenApi(
 *    @OA\Server(url="http://localhost/web-programming2023_blog/rest", description="Development Environment" ),
 *    @OA\Server(url="https://myuniblog.me/rest", description="Production Environment" )
 * ),
 * @OA\SecurityScheme(securityScheme="ApiKeyAuth", type="apiKey", in="header", name="Authentication" )
 */
