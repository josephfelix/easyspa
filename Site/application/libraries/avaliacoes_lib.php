<?php
class Avaliacoes_lib
{
	public function formatar($pontuacao = 0, $avaliacoes = 0)
	{
		if ($avaliacoes != 0)
		{
			return number_format($pontuacao/$avaliacoes, 1, ',', ' ');
		}
		return 0;
	}
}
?>