		<?php echo form_open('c_spp/to_month'); ?>
		<!-- start id-form -->
		
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
			<th valign="top">Jumlah:</th>
			<td><?=$spp[0]->jumlah_spp?></td>
		</tr>
		<tr>
			<th valign="top">Tahun ke:</th>
			<td>
				<input type="text" class="inp-form" name="tahun_spp" />
			</td>
		</tr>
		<input type="hidden" readonly class="inp-form" name="id_spp" value="<?=$spp[0]->id_spp?>" />
		<tr>
			<td valign="top">
				<input type="submit" value="" class="form-submit" />
			</td>
			<td>
				<a href="/school/c_spp">Kembali</a>
			</td>
		</tr>
		</table>
		<?php echo form_close(); ?>	
		<!-- end id-form  -->		