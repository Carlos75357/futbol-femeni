<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Jugador;
use App\Models\Equip;

class JugadorControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_usuario_puede_listar_jugadores()
    {
        $jugadores = Jugador::factory()->count(3)->create();

        $response = $this->get(route('jugadors.index'));

        $response->assertStatus(200);
        $response->assertSee($jugadores[0]->nom);
    }

    /** @test */
    public function un_usuario_puede_crear_un_jugador()
    {
        $equipo = Equip::factory()->create();
        $data = [
            'nom' => 'Lionel Messi',
            'edat' => 36,
            'equip_id' => $equipo->id,
        ];

        $response = $this->post(route('jugadors.store'), $data);

        $response->assertRedirect(route('jugadors.index'));
        $this->assertDatabaseHas('jugadors', $data);
    }

    /** @test */
    public function un_usuario_puede_ver_el_detalle_de_un_jugador()
    {
        $jugador = Jugador::factory()->create();

        $response = $this->get(route('jugadors.show', $jugador));

        $response->assertStatus(200);
        $response->assertSee($jugador->nom);
    }

    /** @test */
    public function un_usuario_puede_actualizar_un_jugador()
    {
        $jugador = Jugador::factory()->create();
        $data = ['nom' => 'Cristiano Ronaldo'];

        $response = $this->put(route('jugadors.update', $jugador), $data);

        $response->assertRedirect(route('jugadors.index'));
        $this->assertDatabaseHas('jugadors', $data);
    }

    /** @test */
    public function un_usuario_puede_eliminar_un_jugador()
    {
        $jugador = Jugador::factory()->create();

        $response = $this->delete(route('jugadors.destroy', $jugador));

        $response->assertRedirect(route('jugadors.index'));
        $this->assertDatabaseMissing('jugadors', ['id' => $jugador->id]);
    }
}
