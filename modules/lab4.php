<form action="javascript:void(0)" method="post" name='lab4_form' id='lab4_form'>
	<table class="lab4">
		<tr>
			<th colspan="3">
				Name:
			</th>
		</tr>
		<tr>
			<td>
				<select>
				  	<option value="nil">--</option>
				  	<option value="mr">Mr. </option>
				  	<option value="mrs">Mrs. </option>
				</select>		
			</td>
			<td>
				<input type="text" size="15" maxlength="15" name="first_name" id="first_name">
			</td>
			<td>
				<input type="text" size="25" maxlength="25" name="last_name" id="last_name">
			</td>
		</tr>
		<tr>
			<td>Salutation</td>
			<td>First</td>
			<td>Last</td>
		</tr>
		<tr>
			<th colspan="3">
				<br/>School:
			</th>
		</tr>
		<tr>
			<td colspan="3">
				<input type="text" size="56" maxlength="56" name="school_name" id="school_name">
			</td>
		</tr>
		<tr>
			<th colspan="3">
				<br/>E-Mail:
			</th>
		</tr>
		<tr>
			<td colspan="3">
				<input type="text" size="56" maxlength="56" name="email" id="email">
			</td>
		</tr>
		<tr>
			<th colspan="3">
				<br/>Phone:
			</th>
		</tr>
		<tr>
			<td colspan="3">
				<table>
					<tr>
						<td>
							<input type="text" size="3" maxlength="3" name="phone-1" id="phone-1">-
						</td>
						<td>
							<input type="text" size="3" maxlength="3" name="phone-2" id="phone-2">-
						</td>
						<td>
							<input type="text" size="4" maxlength="4" name="phone-3" id="phone-3">
						</td>
					</tr>
					<tr>
						<td>###</td>
						<td>###</td>
						<td>####</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th colspan="3">
				<br/>Delivery Method:
			</th>
		</tr>
		<tr>
			<td colspan="3">
				<input type="radio" name="delivery" value="f2f">Face to Face<br>
				<input type="radio" name="delivery" value="hybrid">Hybrid<br>
				<input type="radio" name="delivery" value="Online">Online
			</td>
		</tr>
		<tr>
			<th colspan="3">
				<br/>Semester Starts:
			</th>
		</tr>
		<tr>
			<td colspan="3">
				<table>
					<tr>
						<td>
							<input type="text" size="2" maxlength="2" name="semester-starts-1" id="semester-starts-1">-
						</td>
						<td>
							<input type="text" size="2" maxlength="2" name="semester-starts-2" id="semester-starts-2">-
						</td>
						<td>
							<input type="text" size="4" maxlength="4" name="semester-starts-3" id="semester-starts-3">
						</td>
					</tr>
					<tr>
						<td>MM</td>
						<td>DD</td>
						<td>YYYY</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th colspan="3">
				<br/>Semester Ends:
			</th>
		</tr>
		<tr>
			<td colspan="3">
				<table>
					<tr>
						<td>
							<input type="text" size="2" maxlength="2" name="semester-ends-1" id="semester-ends-1">-
						</td>
						<td>
							<input type="text" size="2" maxlength="2" name="semester-ends-2" id="semester-ends-2">-
						</td>
						<td>
							<input type="text" size="4" maxlength="4" name="semester-ends-3" id="semester-ends-3">
						</td>
					</tr>
					<tr>
						<td>MM</td>
						<td>DD</td>
						<td>YYYY</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th colspan="3">
				<input type="submit" id="submit" value="Submit">
			</th>
		</tr>
	</table>
	<input type="hidden" name="userId" value="12">
</form>
