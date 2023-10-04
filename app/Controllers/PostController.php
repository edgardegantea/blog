<?php

namespace App\Controllers;

class PostController extends BaseController
{

	public function ejercicio01()
	{
		$db = \Config\Database::connect();
		$posts = $db->query('select c.category, p.id, p.title, u.username, p.created_at from categories as c right join posts as p on p.category = c.id left join users as u on u.id = p.autor where p.created_at between "2023/01/01" and "2023/12/31"')->getResultArray();

		$data = [
			'posts' => $posts
		];

		return view('posts/ejercicio01', $data);
	}



	public function ejercicio05()
	{
		// 5. Mostrar una tabla con los siguientes datos: cantidad total de usuarios registrados, cantidad total de posts, cantidad total de comentarios, cantidad total de categorias.

		$db = \Config\Database::connect();
		$totalUsers = $db->query('select count(*) as "totalUsuarios" from users')->getResultArray();

		$totalPosts = $db->query('select count(*) as "totalPublicaciones" from posts')->getResultArray();
		
		$totalComments = $db->query('select count(*) as "totalComentarios" from comments')->getResultArray();

		$totalCategories = $db->query('select count(*) as "totalCategorias" from categories')->getResultArray();

		$data = [
			'totalUsers'		=> $totalUsers,
			'totalPosts'		=> $totalPosts,
			'totalComments'		=> $totalComments,
			'totalCategories'	=> $totalCategories
		];

		return view('posts/ejercicio05', $data);
	}
}