<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Partit;
use App\Models\Equip;

class PartitsControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_usuario_puede_listar_partits()
    {
        $partits = Partit::factory()->count(3)->create();

        $response = $this->get(route('partits.index'));

        $response->assertStatus(200);
        $response->assertSee($partits[0]->equip_local_id);
    }

    /** @test */
    public function un_usuario_puede_crear_un_partit()
    {
        $equip1 = Equip::factory()->create();
        $equip2 = Equip::factory()->create();
        $data = [
            'equip_local_id' => $equip1->id,
            'equip_visitant_id' => $equip2->id,
            'resultat' => '2-1',
        ];

        $response = $this->post(route('partits.store'), $data);

        $response->assertRedirect(route('partits.index'));
        $this->assertDatabaseHas('partits', ['equip_local_id' => $equip1->id, 'equip_visitant_id' => $equip2->id]);
    }

    /** @test */
    public function un_usuario_puede_ver_el_detalle_de_un_partit()
    {
        $partit = Partit::factory()->create();

        $response = $this->get(route('partits.show', $partit));

        $response->assertStatus(200);
        $response->assertSee($partit->equip_local_id);
    }

    /** @test */
    public function un_usuario_puede_actualizar_un_partit()
    {
        $partit = Partit::factory()->create();
        $data = ['resultat' => '3-0'];

        $response = $this->put(route('partits.update', $partit), $data);

        $response->assertRedirect(route('partits.index'));
        $this->assertDatabaseHas('partits', ['id' => $partit->id, 'gols_local' => 3]);
    }

    /** @test */
    public function un_usuario_puede_eliminar_un_partit()
    {
        $partit = Partit::factory()->create();

        $response = $this->delete(route('partits.destroy', $partit));

        $response->assertRedirect(route('partits.index'));
        $this->assertDatabaseMissing('partits', ['id' => $partit->id]);
    }
}
