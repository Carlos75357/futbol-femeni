<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Estadi;

class EstadiControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_usuario_puede_listar_estadis()
    {
        $estadis = Estadi::factory()->count(3)->create();

        $response = $this->get(route('estadis.index'));

        $response->assertStatus(200);
        $response->assertSee($estadis[0]->nom);
    }

    /** @test */
    public function un_usuario_puede_crear_un_estadi()
    {
        $data = [
            'nom' => 'Camp Nou',
            'ciutat' => 'Barcelona',
            'capacitat' => 99354,
        ];

        $response = $this->post(route('estadis.store'), $data);

        $response->assertRedirect(route('estadis.index'));
        $this->assertDatabaseHas('estadis', $data);
    }

    /** @test */
    public function un_usuario_puede_ver_el_detalle_de_un_estadi()
    {
        $estadi = Estadi::factory()->create();

        $response = $this->get(route('estadis.show', $estadi));

        $response->assertStatus(200);
        $response->assertSee($estadi->nom);
    }

    /** @test */
    public function un_usuario_puede_actualizar_un_estadi()
    {
        $estadi = Estadi::factory()->create();
        $data = ['nom' => 'Spotify Camp Nou'];

        $response = $this->put(route('estadis.update', $estadi), $data);

        $response->assertRedirect(route('estadis.index'));
        $this->assertDatabaseHas('estadis', $data);
    }

    /** @test */
    public function un_usuario_puede_eliminar_un_estadi()
    {
        $estadi = Estadi::factory()->create();

        $response = $this->delete(route('estadis.destroy', $estadi));

        $response->assertRedirect(route('estadis.index'));
        $this->assertDatabaseMissing('estadis', ['id' => $estadi->id]);
    }
}
