<?php


namespace Tests\Feature\post;


use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use WithFaker;
    /**
     * @test
     */
    public function login_user_can_create_new_post(){
        //create new user
        $user = User::factory()->create();
        //check user is exist in db
        $this->assertDatabaseHas('users',[
           'email' =>$user->email,
        ]);
        //create dummy data
        $data = [
          'title' =>$this->faker->sentence,
          'body' =>$this->faker->paragraph(3),
        ];
        //send request
        $response =  $this->actingAs($user)->post('/post',$data);
        $response->assertRedirect('/dashboard');
        $response->assertStatus(302);
        $this->assertDatabaseHas('posts',[
           'title' => $data['title']
        ]);
    }

    /**
     * @test
     */
    public function guest_can_not_create_post_and_redirect_to_login_page(){
        //create dummy data
        $data = [
            'title' =>$this->faker->sentence,
            'body' =>$this->faker->paragraph(3),
        ];
        //send request
        $response =  $this->post('/post',$data);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('posts',[
            'title' => $data['title']
        ]);
     }

    /**
     * @test
     */
    public function create_post_with_missing_title_field(){
        //create new user
        $user = User::factory()->create();
        //create dummy data
        $data = [
            'body' =>$this->faker->paragraph(3),
        ];
        //send request
        $response =  $this->actingAs($user)->post('/post',$data);
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('posts',[
            'body' => $data['body']
        ]);
    }
    /**
     * @test
     */
    public function create_post_with_missing_body_field(){
        //create new user
        $user = User::factory()->create();
        //create dummy data
        $data = [
            'title' =>$this->faker->sentence,
        ];
        //send request
        $response =  $this->actingAs($user)->post('/post',$data);
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('posts',[
            'title' => $data['title']
        ]);
    }

}
