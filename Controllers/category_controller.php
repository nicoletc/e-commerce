<?php
require_once __DIR__ . '/../settings/core.php';
require_once __DIR__ . '/../Classes/category_class.php';

function add_category_ctr(array $k): array {
    if (!is_logged_in() || !is_admin()) return ['status'=>'error','message'=>'Unauthorized'];
    $name = trim($k['cat_name'] ?? '');
    if ($name === '') return ['status'=>'error','message'=>'Category name is required'];
    if (strlen($name) > 100) return ['status'=>'error','message'=>'Max 100 characters'];

    $cat = new Category();
    if ($cat->existsByName($name)) return ['status'=>'error','message'=>'Category already exists'];
    $id = $cat->add($name);
    return $id ? ['status'=>'success','message'=>'Category created','cat_id'=>$id]
               : ['status'=>'error','message'=>'Create failed'];
}

function fetch_categories_ctr(): array {
    if (!is_logged_in() || !is_admin()) return ['status'=>'error','message'=>'Unauthorized'];
    return ['status'=>'success','data'=>(new Category())->listAll()];
}

function update_category_ctr(array $k): array {
    if (!is_logged_in() || !is_admin()) return ['status'=>'error','message'=>'Unauthorized'];
    $id   = (int)($k['cat_id'] ?? 0);
    $name = trim($k['cat_name'] ?? '');
    if ($id <= 0 || $name === '') return ['status'=>'error','message'=>'Invalid data'];
    if (strlen($name) > 100) return ['status'=>'error','message'=>'Max 100 characters'];

    $ok = (new Category())->rename($id, $name); // update by ID (case-sensitive name is preserved)
    return $ok ? ['status'=>'success','message'=>'Category updated'] : ['status'=>'error','message'=>'Update failed'];
}

function delete_category_ctr(array $k): array {
    if (!is_logged_in() || !is_admin()) return ['status'=>'error','message'=>'Unauthorized'];
    $id = (int)($k['cat_id'] ?? 0);
    if ($id <= 0) return ['status'=>'error','message'=>'Invalid id'];
    $ok = (new Category())->remove($id);
    return $ok ? ['status'=>'success','message'=>'Category deleted'] : ['status'=>'error','message'=>'Delete failed'];
}
