<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Главная
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('home'));
});

// Каталог
Breadcrumbs::for('catalog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Каталог', route('catalog'));
});

Breadcrumbs::for('categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home'); // Наследуем от главной
    $trail->push('Категории', route('categories.index'));
});

// Отдельная категория (если нужно)
Breadcrumbs::for('categories.show', function (BreadcrumbTrail $trail, Category $category) {
    $trail->parent('categories.index');
    $trail->push($category->name, route('categories.show', $category));
});

// Товар
Breadcrumbs::for('product', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('category', $product->category);
    $trail->push($product->name, route('product', $product));
});
