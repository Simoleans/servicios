<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Producto;
use App\Models\Producto as ProductoModels;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductosTest extends TestCase
{

    /**
     * @test 
     */
    function existe_componente_producto_index_de_productos()
    {
        //$this->actingAs(User::factory()->create());
        
        $this->withoutExceptionHandling();

        $credentials = [
            "email" => "admin@gmail.com",
            "password" => "admin123456"
        ];

        $response = $this->post('login', $credentials);
        $response->assertRedirect('/dashboard');
        $this->assertCredentials($credentials);

        $this->get('/productos')->assertSeeLivewire('producto')->assertStatus(200);
        
    }

   /** @test  */
   function store_producto_with_method_resetInput_and_closeModal()
    {
        $response = $this->post('/productos');
        Livewire::test(Producto::class)
            ->set('nombre', 'Play Station 5')
            ->set('descripcion_corta', 'descripcion corta')
            ->set('descripcion_larga', 'descripcion laraaga muy larga')
            ->set('foto', 'play/stattion.png')
            ->set('precio_rebajado', '123')
            ->set('precio_normal', '1234')
            ->call('store')
            ->call('resetInput')
            ->call('closeModal')
            ->assertStatus(200);

            //$response->assertSessionHas();
            
    }

    /**
     * @test 
     */
    function exists_method_reset_all_input(){
        Livewire::test(Producto::class)
            ->call('resetInput')
            ->assertStatus(200);
    }

    /**
     * @test 
     */
    function modal_con_input_foto_true(){

        Livewire::test(Producto::class)
            ->call('modalInputFile',true)
            ->assertStatus(200);
    }

    /**
     * @test 
     */
    function modal_con_input_foto_false(){

        Livewire::test(Producto::class)
            ->call('modalInputFile',false)
            ->assertStatus(200);
    }

    /**
     * @test 
     */
    function open_modal_con_datos_para_editar_producto()
    {
        $producto = ProductoModels::factory()->create();

        Livewire::test(Producto::class)
            ->call('edit',$producto->id)
            ->call('modalInputFile',false)
            ->call('resetInput')
            ->call('delete',$producto->id)
            ->assertStatus(200);
    }

    /**
     * @test 
     */
    function componente_para_borrar_producto(){

        $producto = ProductoModels::factory()->create();

        //dd($producto->id);
        Livewire::test(Producto::class)
            ->call('delete',$producto->id)
            ->assertStatus(200);

    }

    
}
