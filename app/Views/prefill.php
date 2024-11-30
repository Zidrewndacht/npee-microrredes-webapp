<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
</head>
<body>
    
<h1>Welcome to CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?></h1>

<?php phpinfo(); ?>

<p>Page rendered in {elapsed_time} seconds using {memory_usage} MB of memory.</p>

<p>Environment: <?= ENVIRONMENT ?></p>

<?php
ini_set('memory_limit', '512M');
        $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
        $db = $mongoClient->microgrid;
        $collection1 = $db->selectCollection('input_meter');
        $collection2 = $db->selectCollection('q1_converter');
        $collection3 = $db->selectCollection('q2_converter');
        $collection4 = $db->selectCollection('q4_converter');
        $collection5 = $db->selectCollection('q3_converter');
        $collection6 = $db->selectCollection('pv_cell');

        // Generate and insert data
        $startTime = strtotime('2024-11-01 7:40:00');
        $endTime = strtotime('2024-11-01 8:00:00');
        $currentTime = $startTime;

        while ($currentTime <= $endTime) {
/** ********************  Input meter: ******************* **/

            $voltages = [rand(209.9, 229.9),    rand(209.9, 229.9), rand(209.9, 229.9)];
            $currents = [ rand(29.9, 49.9),       rand(29.9, 49.9),    rand(29.9, 49.9)  ];
            $reactivePowers = [rand(-9999.9, 9999.9), rand(-9999.9, 9999.9), rand(-9999.9, 9999.9)];
            $frequency = rand(595, 605) / 10.0;
            // Calculate active power
            $activePowers = [
                $voltages[0] * $currents[0],
                $voltages[1] * $currents[1],
                $voltages[2] * $currents[2]
            ];

            // Insert data into MongoDB
            $data1 = [
                '_id' => new MongoDB\BSON\ObjectId(),
                'datetime' => new MongoDB\BSON\UTCDateTime($currentTime * 1000),
                'voltage_per_phase' => $voltages,
                'current_per_phase' => $currents,
                'active_power_per_phase' => $activePowers,
                'reactive_power_per_phase' => $reactivePowers,
                'input_frequency' => $frequency
            ];

            $collection1->insertOne($data1);

/** ********************  Q1 (AC1, AC2, DC)  ******************* **/
            $voltagesAC1 = [rand(209.9, 229.9), rand(209.9, 229.9), rand(209.9, 229.9)];
            $currentsAC1 = [rand(29.9, 49.9), rand(29.9, 49.9), rand(29.9, 49.9)];
            $reactivePowersAC1 = [rand(-9999.9, 9999.9), rand(-9999.9, 9999.9), rand(-9999.9, 9999.9)];
            $pllFrequencyAC1 = rand(595, 605) / 10.0;
            $activePowersAC1 = [
                $voltagesAC1[0] * $currentsAC1[0],
                $voltagesAC1[1] * $currentsAC1[1],
                $voltagesAC1[2] * $currentsAC1[2]
            ];

            // Generate random values for AC 2
            $voltagesAC2 = [rand(209.9, 229.9), rand(209.9, 229.9), rand(209.9, 229.9)];
            $currentsAC2 = [rand(29.9, 49.9), rand(29.9, 49.9), rand(29.9, 49.9)];
            $reactivePowersAC2 = [rand(-9999.9, 9999.9), rand(-9999.9, 9999.9), rand(-9999.9, 9999.9)];
            $pllFrequencyAC2 = rand(595, 605) / 10.0;
            $activePowersAC2 = [
                $voltagesAC2[0] * $currentsAC2[0],
                $voltagesAC2[1] * $currentsAC2[1],
                $voltagesAC2[2] * $currentsAC2[2]
            ];

            // Generate random values for DC 1
            $lineVoltageDC1 = rand(200, 310);
            $lineCurrentDC1 = rand(29.9, 49.9);
            $linePowerDC1 = $lineVoltageDC1 * $lineCurrentDC1;

            // Insert data into MongoDB
            $data2 = [
                '_id' => new MongoDB\BSON\ObjectId(),
                'datetime' => new MongoDB\BSON\UTCDateTime($currentTime * 1000),
                'ac1' => [
                    'voltage_per_phase' => $voltagesAC1,
                    'current_per_phase' => $currentsAC1,
                    'active_power_per_phase' => $activePowersAC1,
                    'reactive_power_per_phase' => $reactivePowersAC1,
                    'pll_frequency' => $pllFrequencyAC1
                ],
                'ac2' => [
                    'voltage_per_phase' => $voltagesAC2,
                    'current_per_phase' => $currentsAC2,
                    'active_power_per_phase' => $activePowersAC2,
                    'reactive_power_per_phase' => $reactivePowersAC2,
                    'pll_frequency' => $pllFrequencyAC2
                ],
                'dc1' => [
                    'line_voltage' => $lineVoltageDC1,
                    'line_current' => $lineCurrentDC1,
                    'line_power' => $linePowerDC1
                ]
            ];
            $collection2->insertOne($data2);


/** ********************  Q2 / Q4 Converters  ******************* **/
            $lineVoltage = rand(200, 310);
            $lineCurrent = rand(29.9, 49.9);
            $linePower = $lineVoltage * $lineCurrent;
            $supercapVoltage = rand(200, 310);
            $supercapCurrent = rand(29.9, 49.9);

            // Insert data into MongoDB
            $data3 = [
                '_id' => new MongoDB\BSON\ObjectId(),
                'datetime' => new MongoDB\BSON\UTCDateTime($currentTime * 1000),
                'line_voltage' => $lineVoltage,
                'line_current' => $lineCurrent,
                'line_power' => $linePower,
                'supercap_voltage' => $supercapVoltage,
                'supercap_current' => $supercapCurrent
            ];
            $collection3->insertOne($data3);

            $lineVoltage = rand(200, 310);
            $lineCurrent = rand(29.9, 49.9);
            $linePower = $lineVoltage * $lineCurrent;
            $supercapVoltage = rand(200, 310);
            $supercapCurrent = rand(29.9, 49.9);

            // Insert data into MongoDB
            $data4 = [
                '_id' => new MongoDB\BSON\ObjectId(),
                'datetime' => new MongoDB\BSON\UTCDateTime($currentTime * 1000),
                'line_voltage' => $lineVoltage,
                'line_current' => $lineCurrent,
                'line_power' => $linePower,
                'supercap_voltage' => $supercapVoltage,
                'supercap_current' => $supercapCurrent
            ];

            $collection4->insertOne($data4);


/** ********************  Q3 Inverter / Battery Data  ******************* **/
            $voltages = [rand(209.9, 229.9), rand(209.9, 229.9), rand(209.9, 229.9)];
            $currents = [rand(29.9, 49.9), rand(29.9, 49.9), rand(29.9, 49.9)];
            $reactivePowers = [rand(-9999.9, 9999.9), rand(-9999.9, 9999.9), rand(-9999.9, 9999.9)];
            $pllFrequency = rand(595, 605) / 10.0;
            $batteryVoltage = rand(200, 310);
            $batteryCurrent = rand(29.9, 49.9);

            // Calculate active power
            $activePowers = [
                $voltages[0] * $currents[0],
                $voltages[1] * $currents[1],
                $voltages[2] * $currents[2]
            ];

            // Insert data into MongoDB
            $data5 = [
                '_id' => new MongoDB\BSON\ObjectId(),
                'datetime' => new MongoDB\BSON\UTCDateTime($currentTime * 1000),
                'voltage_per_phase' => $voltages,
                'current_per_phase' => $currents,
                'active_power_per_phase' => $activePowers,
                'reactive_power_per_phase' => $reactivePowers,
                'pll_frequency' => $pllFrequency,
                'battery_voltage' => $batteryVoltage,
                'battery_current' => $batteryCurrent
            ];

            $collection5->insertOne($data5);

/** ********************  Q5 PV Cell  ******************* **/
            $pvVoltage = rand(200, 310);
            $pvCurrent = rand(29.9, 49.9);

            // Insert data into MongoDB
            $data = [
                '_id' => new MongoDB\BSON\ObjectId(),
                'datetime' => new MongoDB\BSON\UTCDateTime($currentTime * 1000),
                'pv_voltage' => $pvVoltage,
                'pv_current' => $pvCurrent
            ];

            $collection6->insertOne($data);

            $currentTime += 10; // Increment by 10 seconds
        }
        echo "Finished inserting synthetic data\\n";
        ?>
</html>
