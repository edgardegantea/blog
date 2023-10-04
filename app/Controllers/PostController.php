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


	public function ejercicio06()
	{
		$db = \Config\Database::connect();

		$postsPorCategoria = $db->query('select p.*, c.category as ccategory, count(*) as ppc from categories as c join posts as p on p.category = c.id group by category order by category')->getResultArray();

		$postsPorAutor = $db->query('aquí va tu consulta')->getResultArray();

		$data = [
			'postsPorCategoria' => $postsPorCategoria,
			'postsPorAutor' 	=> $postsPorAutor
		];

		return view('posts/ejercicio06', $data);
	}


	public function ejercicio07()
	{
		$db = \Config\Database::connect();

		$postsEscritosPorMujeres2022 = $db->query('select p.*, count(*) as pepm22, u.*, ui.* from posts as p join users as u on p.autor = u.id join userinfo as ui on u.id = ui.id where ui.gender = "f" and p.created_at between "2022/01/01" and "2022/12/31"')->getResultArray();

		$postsEscritosPorMujeres2023 = $db->query('select p.*, count(*) as pepm23, u.*, ui.* from posts as p join users as u on p.autor = u.id join userinfo as ui on u.id = ui.id where ui.gender = "f" and p.created_at between "2023/01/01" and "2023/12/31"')->getResultArray();

		$postsEscritosPorHombres = $db->query('select p.*, count(*) as peph, u.*, ui.* from posts as p join users as u on p.autor = u.id join userinfo as ui on u.id = ui.id where ui.gender = "m" and p.created_at between "2022/01/01" and "2022/12/31"')->getResultArray();

		$postsEscritosPorMujeres2 = $db->query('select p.*, p.title as titulo, p.created_at as creado, u.*, ui.* from posts as p join users as u on p.autor = u.id join userinfo as ui on u.id = ui.id where ui.gender = "f" and p.created_at between "2022/01/01" and "2022/12/31" order by creado ASC')->getResultArray();

		$data = [
			'postsEscritosPorMujeres2022'	=> $postsEscritosPorMujeres2022,
			'postsEscritosPorMujeres2023'	=> $postsEscritosPorMujeres2023,
			'postsEscritosPorMujeres2'		=> $postsEscritosPorMujeres2,
			'postsEscritosPorHombres'		=> $postsEscritosPorHombres,
		];

		return view('posts/ejercicio07', $data);
	}

}