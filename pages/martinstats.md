---
layout: page
title: Martin Črepinšek
permalink: /martinstats/
---

# Martin Črepinšek

Official live statistics.

<div id="stats">Loading player stats...</div>

<style>
  body {
    font-family: sans-serif;
    padding: 20px;
  }
  table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 1rem;
  }
  td,
  th {
    border: 1px solid #ccc;
    padding: 6px;
    text-align: center;
  }
  th {
    background-color: #eee;
  }
</style>

<script>
  async function loadStats() {
    const container = document.getElementById("stats");
    try {
      const response = await fetch("https://okkoreboot.com/api/player-info");
      const xmlText = await response.text();

      const parser = new DOMParser();
      const xmlDoc = parser.parseFromString(xmlText, "application/xml");

      const description = xmlDoc.querySelector("channel > item > description");
      if (!description) {
        container.innerHTML = "No player stats found.";
        return;
      }

      const htmlContent = description.textContent;
      const innerParser = new DOMParser();
      const htmlDoc = innerParser.parseFromString(htmlContent, "text/html");
      const table = htmlDoc.querySelector("table");

      if (!table) {
        container.innerHTML = "No table found in stats description.";
        return;
      }

      container.innerHTML = "";
      container.appendChild(table);

      const rows = Array.from(table.querySelectorAll("tr")).slice(1);
      let lastSeason = "";

      rows.forEach((row) => {
        const seasonCell = row.cells[0];
        if (seasonCell) {
          const seasonText = seasonCell.textContent.trim();
          if (/^\d{4}-\d{4}$/.test(seasonText)) {
            lastSeason = seasonText;
          } else if (lastSeason) {
            seasonCell.textContent = lastSeason;
          }
        }
      });

      const seasonRows = rows.sort((a, b) => {
        const aSeason = a.cells[0]?.textContent.trim();
        const bSeason = b.cells[0]?.textContent.trim();
        const aTP = parseInt(a.cells[6]?.textContent.trim()) || 0;
        const bTP = parseInt(b.cells[6]?.textContent.trim()) || 0;

        const aYear = parseInt(aSeason?.split("-")[0]) || 0;
        const bYear = parseInt(bSeason?.split("-")[0]) || 0;

        if (aYear === bYear) return bTP - aTP;
        return bYear - aYear;
      });

      const headerRow = table.querySelector("tr");
      const allRows = [headerRow, ...seasonRows];
      const indexesToRemove = [14, 7];

      allRows.forEach((row, ind) => {
        indexesToRemove.forEach((index) => {
          if (row.cells.length > index) {
            row.deleteCell(index);
          }
        });
        row.style.backgroundColor = ind % 2 === 0 ? "#ffffff" : "#f0f0f0";
      });

      table.innerHTML = "";
      table.appendChild(allRows[0]);
      seasonRows.forEach((row) => table.appendChild(row));
    } catch (err) {
      console.error(err);
      container.textContent = "Failed to load or parse player stats.";
    }
  }

  window.addEventListener("DOMContentLoaded", loadStats);
</script>
