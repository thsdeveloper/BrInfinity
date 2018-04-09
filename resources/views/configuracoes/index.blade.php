@extends('layouts.app')
@section('title', 'Configurações')
@section('content')
  <el-tabs type="border-card">
    <el-tab-pane label="Permissões de Usuários">
      Permission users
    </el-tab-pane>
    <el-tab-pane label="Notificações">Notificações...</el-tab-pane>
    <el-tab-pane label="Codigo BNC">Codigo BNC..</el-tab-pane>
    <el-tab-pane label="Email Marketing">Email Marketing...</el-tab-pane>
  </el-tabs>
@endsection
