<?php

namespace App\Traits;

trait Support
{
  private function push_breadcrumb($title, $link, $type, $delete = FALSE)
  {
    $breadcrumb = session("breadcrumb");

    if ($delete) {
      $breadcrumb = [[
        "link" => $link,
        "title" => $title,
        "type" => $type
      ]];

      session(["breadcrumb" => $breadcrumb]);
    } else {
      if (!empty($breadcrumb)) {
        $breadcrumb_collect = collect($breadcrumb);

        $index = array_search($link, array_column($breadcrumb, "link"));
        // $index_type = array_search($type, array_column($breadcrumb, "type"));
        $find_breadcrumb = $breadcrumb_collect->filter(function ($bread) use ($type) {
          return $bread["type"] == $type;
        })->keys()->toArray();

        // dump($find_breadcrumb);
        // dd($breadcrumb);
        if ($index !== FALSE || count($find_breadcrumb) > 0) {
          if (count($find_breadcrumb) > 0) {
            $end_array = end($find_breadcrumb) - 1;
            if ($end_array < 1) {
              $end_array = 1;
            }
            $breadcrumb = array_splice($breadcrumb, 0, $end_array);
          } else {
            $breadcrumb = array_splice($breadcrumb, 0, $index);
          }
        }
      } else {
        $breadcrumb = [];
      }

      $data = [
        "link" => $link,
        "title" => $title,
        "type" => $type
      ];

      array_push($breadcrumb, $data);
      session(["breadcrumb" => $breadcrumb]);
    }
  }

  private function draw_breadcrumb($title, $link, $type, $delete = FALSE)
  {
    $this->push_breadcrumb($title, $link, $type, $delete);

    $data = session("breadcrumb");
    $last = count($data);
    $i = 1;
    $html = "<ol class='breadcrumb'>";
    foreach ($data as $item) {
      if ($i != $last) {
        $html .= "<li class='breadcrumb-item'><a href='" . $item["link"] . "'>" . $item["title"] . "</a></li>";
      } else {
        $html .= "<li class='breadcrumb-item active'>" . $item["title"] . "</li>";
      }
      $i++;
    }
    $html .= "</ol>";
    return $html;
  }

  public function view_admin($view_name, $title, array $data = [], $first_page = FALSE)
  {
    $data["title"] = $title;
    $current_url = url()->current();
    $list_query_string = \request()->query();
    $query_string = "?";
    $delimiter = "";
    foreach ($list_query_string as $key => $value) {
      $query_string .= "$delimiter$key=$value";
      $delimiter = "&";
    }
    $full_url = "$current_url$query_string";

    $type_breadcrumb = \Illuminate\Support\Str::random(6);
    if (isset($data["type_breadcrumb"])) {
      $type_breadcrumb = $data["type_breadcrumb"];
    }
    $data["breadcrumb"] = $this->draw_breadcrumb($title, $full_url, $type_breadcrumb, $first_page);

    return \view("admin.$view_name", $data);
  }
}
