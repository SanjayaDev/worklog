<?php 

if (!function_exists("dashboard_url")) {
  function dashboard_url($url) {
    return "/dashboard/$url";
  }
}