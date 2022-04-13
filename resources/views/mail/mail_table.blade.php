<!DOCTYPE html>
<html>
<head>
	<title>Student Data</title>
	<style>
		table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid #ddd;
      text-align: left;
      padding: 8px;
      color:black
    }

    tr:nth-child(even){background-color: #f2f2f2}
    th {
      background-color: #4CAF50;
      color: white;
    }
  </style>
</head>
<body>
  <table>
    <thead>
      <tr>
        <th>Column</th>
        <th>Value</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Reg. No</td>
        <td>{{ $patient->patient_id }}</td>
      </tr>
      <tr>
        <td>Patient Name</td>
        <td>{{ $patient->patient_name }}</td>
      </tr>
      <tr>
        <td>Father Name</td>
        <td>{{ $patient->father_name }}</td>
      </tr>
      <tr>
        <td>Date of Birth</td>
        <td>{!! $patient->birth_date !!}</td>
      </tr>
      <tr>
        <td>Guardian Number</td>
        <td>{{ $patient->guardian_number }}</td>
      </tr>
      <tr>
        <td>Patient</td>
        <td>{{ $patient->patient_id }}</td>
      </tr>
      <tr>
        <td>Patient</td>
        <td>{{ $patient->patient_id }}</td>
      </tr>
      <tr>
        <td>Patient</td>
        <td>{{ $patient->patient_id }}</td>
      </tr>
    </tbody>
  </table>
  <img src="{{ $message->embed($path_file) }}" alt="No Image">
</body>
</html>