---
layout: page
description: Hockey Stick Flex Calculator
title: Hockey Stick Flex Calculator
permalink: /flexcalculator/
---

# Hockey Stick Flex Calculator

<style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        max-width: 1000px;
        margin: auto;
    }

    input,
    button {
        display: block;
        padding: 10px;
        margin: 10px 0;
        width: 30%;
        box-sizing: border-box;
    }

    .result {
        margin-top: 20px;
        font-weight: bold;
    }

    .flex-chart {
        position: relative;
        margin-top: 30px;
        height: 40px;
        background: linear-gradient(
            to right,
            #ffe0b2,
            #ffcc80,
            #ffb74d,
            #ffa726,
            #ff9800
        );
        border: 1px solid #ccc;
        border-radius: 8px;
    }

    .flex-labels {
        display: flex;
        justify-content: space-between;
        margin-top: 5px;
        font-size: 14px;
    }

    .line-marker {
        position: absolute;
        top: 0;
        width: 2px;
        height: 100%;
        transform: translateX(-1px);
    }

    .line-label {
        position: absolute;
        top: -20px;
        font-size: 12px;
        transform: translateX(-50%);
    }

    .reference-line {
        background-color: blue;
    }

    .reference-label {
        color: blue;
    }

    .calc-line {
        background-color: red;
    }

    .calc-label {
        color: red;
    }
</style>

<label for="height">Height (cm):</label>
<input type="number" id="height" placeholder="e.g., 170" />

<label for="weight">Weight (kg):</label>
<input type="number" id="weight" placeholder="e.g., 70" />

<button onclick="calculateFlex()">Calculate Flex</button>

<div class="result" id="result"></div>

<div class="flex-chart" id="flexChart">
    <div class="line-marker calc-line" id="calcLine" style="display: none"></div>
    <div class="line-label calc-label" id="calcLabel" style="display: none">Calculated</div>

    <div class="line-marker reference-line" id="referenceLine"></div>
    <div class="line-label reference-label" id="referenceLabel">My Flex</div>

</div>

<div class="flex-labels">
    <span>20</span>
    <span>40</span>
    <span>60</span>
    <span>80</span>
    <span>105</span>
</div>

<script>
    const minFlex = 20;
    const maxFlex = 105;

    function calculateFlex() {
        const height = parseInt(document.getElementById("height").value);
        const weight = parseInt(document.getElementById("weight").value);
        const result = document.getElementById("result");
        const calcLine = document.getElementById("calcLine");
        const calcLabel = document.getElementById("calcLabel");
        const chart = document.getElementById("flexChart");

        if (isNaN(height) || isNaN(weight)) {
            result.textContent = "Please enter valid height and weight.";
            calcLine.style.display = "none";
            calcLabel.style.display = "none";
            return;
        }

        const zones = [
            { minH: 60, maxH: 122, minW: 25, maxW: 40, flex: 20 },
            { minH: 123, maxH: 135, minW: 30, maxW: 50, flex: 30 },
            { minH: 136, maxH: 148, minW: 35, maxW: 60, flex: 40 },
            { minH: 149, maxH: 161, minW: 40, maxW: 70, flex: 50 },
            { minH: 149, maxH: 161, minW: 55, maxW: 75, flex: 60 },
            { minH: 149, maxH: 161, minW: 65, maxW: 85, flex: 65 },
            { minH: 162, maxH: 174, minW: 50, maxW: 85, flex: 70 },
            { minH: 162, maxH: 174, minW: 60, maxW: 95, flex: 75 },
            { minH: 175, maxH: 187, minW: 65, maxW: 100, flex: 85 },
            { minH: 188, maxH: 200, minW: 80, maxW: 110, flex: 95 },
            { minH: 188, maxH: 200, minW: 90, maxW: 120, flex: 105 },
            { minH: 201, maxH: 250, minW: 90, maxW: 120, flex: 120 },
        ];

        const match = zones.find(
            (zone) =>
                height >= zone.minH &&
                height <= zone.maxH &&
                weight >= zone.minW &&
                weight <= zone.maxW,
        );

        if (match) {
            result.textContent = `Recommended Stick Flex: ${match.flex}`;

            const percent = (match.flex - minFlex) / (maxFlex - minFlex);
            const chartWidth = chart.clientWidth;
            const position = percent * chartWidth;

            calcLine.style.left = `${position}px`;
            calcLabel.style.left = `${position}px`;
            calcLine.style.display = "block";
            calcLabel.style.display = "block";
        } else {
            result.textContent = "No flex recommendation found for this combination.";
            calcLine.style.display = "none";
            calcLabel.style.display = "none";
        }
    }

    function positionReferenceLine() {
        requestAnimationFrame(() => {
            const chart = document.getElementById("flexChart");
            const referenceLine = document.getElementById("referenceLine");
            const referenceLabel = document.getElementById("referenceLabel");
            const myFlex = 82;

            const chartWidth = chart.clientWidth;
            if (chartWidth === 0) return;

            const percent = (myFlex - minFlex) / (maxFlex - minFlex);
            const position = percent * chartWidth;

            referenceLine.style.left = `${position}px`;
            referenceLabel.style.left = `${position}px`;
        });
    }

    window.onload = positionReferenceLine;
    window.onresize = () => {
        positionReferenceLine();

        const height = document.getElementById("height").value;
        const weight = document.getElementById("weight").value;

        if (height && weight) {
            calculateFlex();
        }
    };
</script>
