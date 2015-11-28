<?php
class Categorias_lib
{
	public function nome( $idcategoria = 0 )
	{
		switch ( $idcategoria )
		{
			case 1:
				return 'Pés e Mãos';
			break;
			case 2:
				return 'Massagem';
			break;
			case 3:
				return 'Cabelereiro';
			break;
			case 4:
				return 'Maquiagem';
			break;
			case 5:
				return 'Depilação';
			break;
			case 6:
				return 'Design de Sobrancelha';
			break;
			case 7:
				return 'Cílios';
			break;
			case 8:
				return 'Estética facial';
			break;
			case 9:
				return 'Estética corporal';
			break;
			case 10:
				return 'Práticas integrativas';
			break;
			case 11:
				return 'Piercing / Tatuagem';
			break;
			case 12:
				return 'Personal Trainer';
			break;
			case 13:
				return 'Fisioterapia / Pilates / RPG';
			break;
			case 14:
				return 'Nutrição';
			break;
			case 15:
				return 'Odontologia';
			break;
			case 16:
				return 'Salão';
			break;
			case 17:
				return 'Academia';
			break;
			case 18:
				return 'Spa';
			break;
			case 19:
				return 'Clínica de Estética';
			break;
			case 20: 
				return 'Hidroterapia/Hidroginástica/Natação';
			break;
			case 21: 
				return 'Acupuntura / Auriculoterapia';
			break;
			case 22:
				return 'Yoga / Reike';
			break;
			default:
				return 'Categoria não identificada';
			break;
		}
	}
}
?>