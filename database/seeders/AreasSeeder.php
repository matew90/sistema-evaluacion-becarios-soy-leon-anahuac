<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


       DB::table('areas')->insert([
         ['id' => '1','ar_uID' => '43b04950-9a78-4f2d-bc96-e297caf7cc95','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Sin Asignar','ar_subname' => '','ar_nickname' => 'SA','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '2','ar_uID' => '844f3425-6c27-4f9d-9b66-e619e0771ea7','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Compromiso Social','ar_subname' => '','ar_nickname' => 'CS','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '3','ar_uID' => '48001369-8a50-40ba-a4b1-30fddf34e791','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Compromiso Social','ar_subname' => 'Servicio Social','ar_nickname' => 'CS','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '4','ar_uID' => '33f541e7-c782-4d19-9f5c-5237d9ce0bf6','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Arte y Cultura','ar_subname' => '','ar_nickname' => 'AYC','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '5','ar_uID' => 'cf272f12-dd1f-4c32-84a0-5a2629ffa1db','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Pastoral Universitaria','ar_subname' => '','ar_nickname' => 'PU','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '6','ar_uID' => '3beba965-b796-4946-a4e1-14042a5b0e0e','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Pastoral Universitaria','ar_subname' => 'Pastoral Adultos','ar_nickname' => 'PA','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '7','ar_uID' => '6cf3b564-7a52-4d7a-b19c-5d9abfba6fc7','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Pastoral Universitaria','ar_subname' => 'Pastoral Juvenil','ar_nickname' => 'PJ','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '8','ar_uID' => 'b2233613-661d-4c3c-b1f1-7d27162e3762','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Deportes','ar_subname' => '','ar_nickname' => 'DEP','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '9','ar_uID' => 'b997031e-2754-47f9-8d69-43b3095eae0e','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Bloque Anáhuac Electivo','ar_subname' => '','ar_nickname' => 'BAE','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '10','ar_uID' => '0f55a426-cf08-4242-a57c-9ce684449d35','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Centro de Atencion Estudiantil','ar_subname' => '','ar_nickname' => 'CAE','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '11','ar_uID' => 'e8eaf18c-95e5-4def-a54c-eac2e0993e30','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Relaciones Estudiantiles','ar_subname' => '','ar_nickname' => 'RE','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '12','ar_uID' => '92821feb-c5bb-4dbe-9991-425204641948','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Relaciones Estudiantiles','ar_subname' => 'Fesal','ar_nickname' => 'FESAL','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '13','ar_uID' => 'b114737d-2977-4dca-89dc-7395e6b32bcf','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Relaciones Estudiantiles','ar_subname' => 'Adefa','ar_nickname' => 'ADEFA','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '14','ar_uID' => '0f08b818-b970-42ec-a18a-6b49fe6a14b8','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Programas de Liderazgo y Excelencia','ar_subname' => '','ar_nickname' => 'PL','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '15','ar_uID' => '7410f1c6-891e-4d99-8fe4-3eb7e4bf0aaa','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Programas de Liderazgo y Excelencia','ar_subname' => 'Vértice','ar_nickname' => 'PLV','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '16','ar_uID' => '1bffcef2-ac8e-4a47-8f8a-87a72ad9b554','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Programas de Liderazgo y Excelencia','ar_subname' => 'Sinergia','ar_nickname' => 'PLS','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '17','ar_uID' => '3d49aa12-419e-486d-b406-b038b6d2464f','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Programas de Liderazgo y Excelencia','ar_subname' => 'Culmen','ar_nickname' => 'PLC','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '18','ar_uID' => 'af2c9325-c0fd-4e2e-9ceb-b5665f9163c8','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Programas de Liderazgo y Excelencia','ar_subname' => 'Impulsa','ar_nickname' => 'PLIM','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '19','ar_uID' => 'c2720087-a3b6-4939-9d5a-217ab3c4cf57','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Programas de Liderazgo y Excelencia','ar_subname' => 'Alpha','ar_nickname' => 'PLA','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '20','ar_uID' => 'd876b87a-105f-4bf3-a9f6-4e5d19f19c59','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Programas de Liderazgo y Excelencia','ar_subname' => 'Genera','ar_nickname' => 'PLG','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '21','ar_uID' => '162862f5-b776-4b1e-bc13-39a4046a905a','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Programas de Liderazgo y Excelencia','ar_subname' => 'Innova','ar_nickname' => 'PLIN','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '22','ar_uID' => 'd8c82c6e-1633-4c8e-ad71-f8c4642b8b52','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Programas de Liderazgo y Excelencia','ar_subname' => 'Programa V','ar_nickname' => 'PV','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '23','ar_uID' => 'f2309488-26e5-49ca-a8f5-fb78f521c8a6','dep_uID' => '7166ca3d-b710-44e8-ad77-e845abbc164d','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Programas de Liderazgo y Excelencia','ar_subname' => 'PLEAs transversal','ar_nickname' => 'PLEAT','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '24','ar_uID' => '190301cc-9a6f-4d3d-a644-82818d5a7513','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Administración Turistica','ar_subname' => '','ar_nickname' => 'ECSADT','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '25','ar_uID' => '1e4efd45-2b21-4c13-bbd9-d843752e052f','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Arquitectura','ar_subname' => '','ar_nickname' => 'ECSARQ','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '26','ar_uID' => '5035b585-7682-459e-999f-4bbc115efe9e','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Ciencias de la Nutrición','ar_subname' => '','ar_nickname' => 'ECSCNU','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '27','ar_uID' => '75c9e002-43db-4c9d-91c3-3e4462bbda38','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Comunicación','ar_subname' => '','ar_nickname' => 'ECSCOM','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '28','ar_uID' => 'c800efc3-e55d-492b-a3d4-743b9d1748b5','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Derecho','ar_subname' => '','ar_nickname' => 'ECSDER','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '29','ar_uID' => '216b51d4-4a60-4fc0-ad84-d76ea06b32be','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Dirección y Administración de empresas','ar_subname' => '','ar_nickname' => 'ECSDAE','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '30','ar_uID' => 'bbc53850-b250-4324-a21d-b3a2a0052286','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Diseño Grafico','ar_subname' => '','ar_nickname' => 'ECSDIG','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '31','ar_uID' => 'bd511e8d-1890-4004-8615-5efc7d34a69d','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Diseño Industrial','ar_subname' => '','ar_nickname' => 'ECSDII','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '32','ar_uID' => '89b0bbd5-14be-480c-956a-731140be91f1','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Empresas de Entretenimiento','ar_subname' => '','ar_nickname' => 'ECSEME','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '33','ar_uID' => 'c0b2e9dd-7242-470f-ab55-26becdb11556','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Finanzas y Contaduria Publica','ar_subname' => '','ar_nickname' => 'ECSFCP','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '34','ar_uID' => 'fb302a47-195a-4603-b6bb-8e58958f99a6','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Gastronomía','ar_subname' => '','ar_nickname' => 'ESCGAT','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '35','ar_uID' => '28b1ebb1-8c53-424b-957d-339e2b253d21','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Ingenierías','ar_subname' => '','ar_nickname' => 'ESCING','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '36','ar_uID' => 'aa57f9d4-8e0c-4ec9-9c82-973d7c035218','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Medicina','ar_subname' => '','ar_nickname' => 'ESCMED','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '37','ar_uID' => 'b30acc6b-6c5f-4bdc-9ac5-dc8d3b03723c','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Mercadotecnía','ar_subname' => '','ar_nickname' => 'ESCMER','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '38','ar_uID' => '7eb0114e-2cc3-4bc6-a29d-21a8b2d32f73','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Moda, Innovación y Tendencia','ar_subname' => '','ar_nickname' => 'ESCMIT','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '39','ar_uID' => '900e0c4c-ea49-4527-8305-cc7d6bb400d6','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Negocios Internacionales','ar_subname' => '','ar_nickname' => 'ESCNGI','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '40','ar_uID' => 'a194d38d-042c-41a1-9d64-b737117783b1','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Pedagogía Organizacional','ar_subname' => '','ar_nickname' => 'ESCPOR','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '41','ar_uID' => 'ff8750cf-3c08-40a3-a2d4-d502c172be21','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Psicología','ar_subname' => '','ar_nickname' => 'ESCPSI','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '42','ar_uID' => '5590ec4c-a855-48e3-a682-0f1f529a0bda','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Relaciones Internacionales','ar_subname' => '','ar_nickname' => 'ESCREI','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '43','ar_uID' => '3cdde861-4931-42c5-8cd0-7265ec79b349','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Terapia Física y Rehabilitación','ar_subname' => '','ar_nickname' => 'ESCTFR','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '44','ar_uID' => '646f6cd4-fc1a-4d2f-81a9-8580bf0ab294','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Centro de Lenguas','ar_subname' => '','ar_nickname' => 'CNTL','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '45','ar_uID' => 'b480b5a1-90f9-467d-89bf-b2e8c2967bf1','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Coordinación de Humanidades','ar_subname' => '','ar_nickname' => 'CORDH','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '46','ar_uID' => 'f2210059-5469-414d-b527-1c435af475fd','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Promoción de Posgrados y Extensión','ar_subname' => '','ar_nickname' => 'PROPE','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '47','ar_uID' => '2600e647-59a4-4237-966d-180b2b75fb29','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Relaciones Academicas','ar_subname' => '','ar_nickname' => 'RELAC','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '48','ar_uID' => '0dbdb269-7500-4f77-9c79-2d6c1d63a377','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Dirección del Deporte','ar_subname' => '','ar_nickname' => 'DOPT','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '49','ar_uID' => 'f5c39de9-5571-4dd5-b186-8d937c226e37','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Dirección Financiera','ar_subname' => '','ar_nickname' => 'DFINZ','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '50','ar_uID' => 'b88a0cd5-5011-4c2d-9d13-521e9b09b4ef','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Operación Académica','ar_subname' => '','ar_nickname' => 'OPER','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '51','ar_uID' => '36639d1a-1d62-4eff-abdf-c9f9063f62d5','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Métodos Cuantitativos','ar_subname' => '','ar_nickname' => 'METC','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '52','ar_uID' => '74e2b145-f2c2-4a9a-91f6-938b71ae1a0e','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Emprendimiento','ar_subname' => '','ar_nickname' => 'EMPRE','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '53','ar_uID' => 'aeea73f1-cff2-4f24-9d6c-42ee45ad60ab','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Posgrado y Educación Continua','ar_subname' => '','ar_nickname' => 'PEC','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '54','ar_uID' => '962abfb6-4df9-492b-9363-d87a7c7532d8','dep_uID' => 'f0b64868-17f4-47cf-a618-8b7d04d1c663','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Desarrollo Académico','ar_subname' => '','ar_nickname' => 'DESA','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '55','ar_uID' => '67fcf484-5b2c-425a-bbdd-ebbe083874d5','dep_uID' => '10dd44fc-d790-4496-be77-107492ff7501','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Compras','ar_subname' => '','ar_nickname' => 'COMP','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '56','ar_uID' => '4cf9f08a-214b-4fb2-a9ce-b0743532f5ab','dep_uID' => '10dd44fc-d790-4496-be77-107492ff7501','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Servicios Generales','ar_subname' => '','ar_nickname' => 'SERGN','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '57','ar_uID' => '6a7ccea3-4f96-4d6c-b2d3-0e772cc3d22f','dep_uID' => '10dd44fc-d790-4496-be77-107492ff7501','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Eventos','ar_subname' => '','ar_nickname' => 'EVNTS','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '58','ar_uID' => 'b632574f-5b4a-4398-8567-336d414dbea5','dep_uID' => '10dd44fc-d790-4496-be77-107492ff7501','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Servicios de Tecnologia','ar_subname' => '','ar_nickname' => 'STI','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '59','ar_uID' => '5a906fa3-5dee-49a4-8637-30976771b5e1','dep_uID' => '10dd44fc-d790-4496-be77-107492ff7501','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Recursos Humanos','ar_subname' => '','ar_nickname' => 'RRHH','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '60','ar_uID' => 'cf06e902-63ab-44be-9c1c-f39b4d44a22e','dep_uID' => '10dd44fc-d790-4496-be77-107492ff7501','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Mantenimiento','ar_subname' => '','ar_nickname' => 'MTTO','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '61','ar_uID' => '240c87d2-8a65-4b45-85f7-7f1f281d48be','dep_uID' => '10dd44fc-d790-4496-be77-107492ff7501','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Biblioteca','ar_subname' => '','ar_nickname' => 'BIBLI','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '62','ar_uID' => '62e94560-8a45-44d8-b5da-6cf726ba1369','dep_uID' => 'c2c030ef-34de-49e5-975e-f731bd29f862','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Atención Preuniversitaria','ar_subname' => '','ar_nickname' => 'APREU','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '63','ar_uID' => '99e68118-2271-4f34-9ff9-88a019eaa406','dep_uID' => 'c2c030ef-34de-49e5-975e-f731bd29f862','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Comunicación Institucional','ar_subname' => '','ar_nickname' => 'COMUI','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '64','ar_uID' => 'ac97bc4c-d65a-43ac-b327-69781a06b7b0','dep_uID' => 'c2c030ef-34de-49e5-975e-f731bd29f862','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'Servicios Escolares','ar_subname' => '','ar_nickname' => 'SERVC','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL],
         ['id' => '65','ar_uID' => '0d330b7b-4a07-40a4-ae34-6be5a6c10822','dep_uID' => 'c2c030ef-34de-49e5-975e-f731bd29f862','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','ar_name' => 'COVID','ar_subname' => '','ar_nickname' => 'COVID','ar_code' => NULL,'created_by' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2022-12-15 11:22:44','updated_at' => '2022-12-15 11:22:44','deleted_at' => NULL]
      ]);
    }
}
