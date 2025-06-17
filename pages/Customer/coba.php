<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Enterprise Grade Fine Checker</title>
  <!-- Google Material Icons -->
  <link
    href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet"
  />
  <style>
    /* Reset / Base */
    *, *::before, *::after {
      box-sizing: border-box;
    }
    html {
      font-size: clamp(14px, 1.5vw, 18px);
      scroll-behavior: smooth;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      background: #1e1e2f;
      color: #e0e0e8;
      font-family: "Inter", -apple-system, BlinkMacSystemFont,
        "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans",
        "Helvetica Neue", sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    body {
      margin: 0;
      display: flex;
      flex: 1 1 auto;
      min-height: 0;
      overflow: hidden;
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
      width: 12px;
      height: 12px;
    }
    ::-webkit-scrollbar-thumb {
      background: #6366f1;
      border-radius: 20px;
      border: 3px solid transparent;
      background-clip: content-box;
      transition: background-color 0.3s ease;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #4338ca;
    }
    ::-webkit-scrollbar-track {
      background: #2e2e46;
      border-radius: 20px;
    }

    /* Layout */
    #app {
      display: grid;
      grid-template-columns: 280px 1fr;
      grid-template-rows: 64px 1fr 48px;
      grid-template-areas:
        "sidebar header"
        "sidebar main"
        "sidebar footer";
      height: 100vh;
      background: linear-gradient(135deg, #20202d 0%, #2c2c40 100%);
    }

    /* Sidebar */
    aside#sidebar {
      grid-area: sidebar;
      background: rgba(40, 39, 69, 0.8);
      backdrop-filter: blur(15px);
      box-shadow: 0 0 20px rgb(99 102 241 / 0.5);
      display: flex;
      flex-direction: column;
      padding-top: 1rem;
    }
    aside#sidebar header {
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 1.5rem;
      color: #a5b4fc;
      margin-bottom: 1.5rem;
      letter-spacing: 0.05em;
      user-select: none;
      padding: 0 1rem;
      border-bottom: 1px solid #4f46e5;
    }
    nav#sidebar-nav {
      flex: 1 1 auto;
      overflow-y: auto;
      padding: 0 0.5rem;
    }
    nav#sidebar-nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    nav#sidebar-nav li {
      margin-bottom: 0.25rem;
    }
    nav#sidebar-nav button {
      width: 100%;
      background: transparent;
      border: none;
      color: #c7d2fe;
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 12px 1rem;
      font-size: 1rem;
      border-radius: 12px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    nav#sidebar-nav button.active,
    nav#sidebar-nav button:hover,
    nav#sidebar-nav button:focus {
      background: #4f46e5;
      color: #ede9fe;
      outline: none;
      box-shadow: 0 0 8px #818cf8;
    }
    nav#sidebar-nav button .material-icons {
      font-size: 24px;
    }
    nav#sidebar-nav .badge {
      background: #4338ca;
      border-radius: 9999px;
      margin-left: auto;
      padding: 2px 8px;
      font-size: 0.75rem;
      font-weight: 600;
      color: white;
      user-select: none;
    }
    /* Slide-out sidebar for mobile */
    #sidebarToggleBtn {
      display: none;
      position: fixed;
      z-index: 1001;
      top: 0.75rem;
      left: 0.75rem;
      background: #4f46e5;
      border: none;
      border-radius: 50%;
      width: 48px;
      height: 48px;
      color: #ede9fe;
      cursor: pointer;
      box-shadow: 0 0 12px #818cf8;
      transition: background-color 0.3s ease;
    }
    #sidebarToggleBtn:hover,
    #sidebarToggleBtn:focus {
      background: #312e81;
      outline: none;
    }
    @media (max-width: 768px) {
      #app {
        grid-template-columns: 1fr;
        grid-template-rows: 64px 1fr 64px;
        grid-template-areas:
          "header"
          "main"
          "footer";
      }
      aside#sidebar {
        position: fixed;
        top: 0;
        left: -280px;
        width: 280px;
        bottom: 0;
        height: 100vh;
        z-index: 1000;
        transition: left 0.3s ease;
        border-right: 1px solid #4338ca;
      }
      aside#sidebar.open {
        left: 0;
        box-shadow: 2px 0 10px rgb(99 102 241 / 0.7);
      }
      #sidebarToggleBtn {
        display: block;
      }
      main#main-content {
        padding: 1rem;
      }
    }

    /* Header */
    header#header {
      grid-area: header;
      position: sticky;
      top: 0;
      background: rgba(31, 41, 55, 0.8);
      backdrop-filter: blur(18px);
      box-shadow: 0 0 12px rgb(99 102 241 / 0.3);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 1.5rem;
      height: 64px;
      z-index: 1002;
      user-select: none;
    }
    header#header .brand {
      display: flex;
      align-items: center;
      gap: 0.625rem;
      color: #c7d2fe;
      font-weight: 700;
      font-size: 1.25rem;
      letter-spacing: 0.07em;
    }
    header#header .brand .material-icons {
      font-size: 36px;
      color: #6366f1;
      filter: drop-shadow(0 0 1px #4338ca);
    }
    header#header nav {
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    header#header nav button {
      background: transparent;
      border: none;
      color: #a5b4fc;
      cursor: pointer;
      font-size: 20px;
      border-radius: 50%;
      padding: 0.25rem;
      transition: background-color 0.3s ease;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    header#header nav button:focus,
    header#header nav button:hover {
      background-color: #4f46e5;
      color: #ede9fe;
      outline: none;
      box-shadow: 0 0 12px #818cf8;
    }
    header#header nav button .notification-dot {
      position: absolute;
      top: 6px;
      right: 6px;
      width: 10px;
      height: 10px;
      background: #f87171;
      border-radius: 50%;
      border: 2px solid #1e1e2f;
      animation: pulse 1.6s infinite ease-in-out;
    }
    @keyframes pulse {
      0% {
        transform: scale(1);
        opacity: 1;
      }
      50% {
        transform: scale(1.3);
        opacity: 0.6;
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    /* Main Content */
    main#main-content {
      grid-area: main;
      overflow-y: auto;
      padding: 2rem 3rem;
      min-height: calc(100vh - 64px);
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    /* Footer */
    footer#footer {
      grid-area: footer;
      background: rgba(31, 41, 55, 0.75);
      backdrop-filter: blur(10px);
      box-shadow: inset 0 1px 0 rgb(255 255 255 / 0.05);
      color: #94a3b8;
      font-size: 0.9rem;
      text-align: center;
      padding: 0.75rem 1rem;
      user-select: none;
    }

    /* Form Styles */
    form {
      max-width: 720px;
      margin: 0 auto;
      background: rgba(55, 65, 81, 0.85);
      backdrop-filter: blur(8px);
      padding: 2rem 2.5rem;
      border-radius: 16px;
      box-shadow: 0 0 40px rgb(99 102 241 / 0.15);
      display: flex;
      flex-direction: column;
      gap: 1.75rem;
      color: #e0e0e8;
    }
    form h2 {
      font-size: 1.75rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      color: #a5b4fc;
      text-align: center;
      user-select: text;
    }

    label {
      font-weight: 600;
      margin-bottom: 0.2rem;
      display: block;
    }
    input[type="text"],
    input[type="date"],
    select,
    textarea {
      width: 100%;
      padding: 0.75rem 1rem;
      background: #2f3b61;
      border: 1.5px solid #4f46e5;
      border-radius: 12px;
      color: #d1d5db;
      font-size: 1rem;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      font-family: inherit;
      resize: vertical;
      min-height: 38px;
    }
    input[type="text"]:focus,
    input[type="date"]:focus,
    select:focus,
    textarea:focus {
      border-color: #818cf8;
      box-shadow: 0 0 8px #818cf8;
      outline: none;
      background: #374151;
      color: #eef2ff;
    }
    textarea {
      min-height: 100px;
    }
    .error-message {
      color: #f87171;
      font-size: 0.875rem;
      font-weight: 600;
      margin-top: 0.3rem;
      user-select: text;
    }
    button[type="submit"] {
      background: #6366f1;
      color: white;
      font-weight: 700;
      border-radius: 16px;
      border: none;
      cursor: pointer;
      padding: 1rem 1.5rem;
      font-size: 1.1rem;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      align-self: center;
      min-width: 160px;
      user-select: none;
      box-shadow: 0 8px 20px rgb(99 102 241 / 0.5);
    }
    button[type="submit"]:hover,
    button[type="submit"]:focus {
      background: #4338ca;
      box-shadow: 0 10px 30px rgb(67 56 202 / 0.7);
      outline: none;
    }
    button[disabled] {
      background: #7986cb;
      cursor: not-allowed;
      box-shadow: none;
    }

    /* Table for showing stored entries */
    table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(55, 65, 81, 0.75);
      border-radius: 16px;
      box-shadow: 0 0 24px rgb(99 102 241 / 0.2);
      overflow: hidden;
      user-select: none;
    }
    thead {
      background: #4f46e5;
      color: #ede9fe;
      text-align: left;
      font-weight: 700;
    }
    th, td {
      padding: 0.75rem 1rem;
      font-size: clamp(0.8rem, 1vw, 1rem);
      border-bottom: 1px solid #818cf8;
      vertical-align: middle;
    }
    tbody tr:hover {
      background: #4338ca55;
    }
    tbody td.actions button {
      background: transparent;
      border: none;
      color: #a5b4fc;
      cursor: pointer;
      margin-right: 0.5rem;
      transition: color 0.3s ease;
      font-size: 20px;
      vertical-align: middle;
    }
    tbody td.actions button:hover {
      color: #ede9fe;
    }

    /* Notification Toast */
    #toast {
      position: fixed;
      bottom: 24px;
      right: 24px;
      background: #4f46e5;
      color: white;
      padding: 1rem 1.75rem;
      border-radius: 14px;
      box-shadow: 0 0 20px rgb(99 102 241 / 0.8);
      font-weight: 600;
      opacity: 0;
      pointer-events: none;
      transform: translateY(40px);
      transition: opacity 0.4s cubic-bezier(0.23, 1, 0.32, 1),
        transform 0.4s cubic-bezier(0.23, 1, 0.32, 1);
      z-index: 2000;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }
    #toast.show {
      opacity: 1;
      pointer-events: auto;
      transform: translateY(0);
    }
    #toast .material-icons {
      font-size: 24px;
    }
    #toast.success {
      background: #14b8a6;
      box-shadow: 0 0 25px rgb(20 184 166 / 0.85);
    }
    #toast.error {
      background: #ef4444;
      box-shadow: 0 0 25px rgb(239 68 68 / 0.85);
    }

    /* Accessibility */
    :focus-visible {
      outline: 3px solid #8888ff;
      outline-offset: 2px;
    }

    /* Responsive Form Fields */
    .form-group {
      display: flex;
      flex-direction: column;
    }
    @media (min-width: 768px) {
      form {
        gap: 2rem;
      }
      .form-row {
        display: flex;
        gap: 1.5rem;
      }
      .form-row .form-group {
        flex: 1;
      }
    }

  </style>
</head>
<body>
  <button id="sidebarToggleBtn" aria-label="Toggle navigation menu" title="Toggle menu" type="button">
    <span class="material-icons">menu</span>
  </button>
  <div id="app" role="application" aria-label="Fine Checker Application">
    <aside id="sidebar" aria-label="Primary navigation">
      <header>FineCheck Pro</header>
      <nav id="sidebar-nav" role="navigation" aria-label="Main navigation">
        <ul>
          <li>
            <button class="active" aria-current="page">
              <span class="material-icons" aria-hidden="true">assignment</span>
              Checker
              <span class="badge" aria-label="3 pending fines">3</span>
            </button>
          </li>
          <li>
            <button disabled>
              <span class="material-icons" aria-hidden="true">settings</span>
              Settings
            </button>
          </li>
          <li>
            <button disabled>
              <span class="material-icons" aria-hidden="true">info</span>
              About
            </button>
          </li>
        </ul>
      </nav>
      <footer style="text-align:center; font-size:0.8rem; color:#818cf8; padding:1rem;">
        &copy; 2024 FineCheck Inc.
      </footer>
    </aside>
    <header id="header" role="banner">
      <div class="brand" aria-label="FineCheck Pro brand">
        <span class="material-icons" aria-hidden="true" aria-label="Brand icon">gavel</span>
        FineCheck Pro
      </div>
      <nav aria-label="User controls">
        <button id="themeToggle" aria-label="Toggle theme (dark or light)">
          <span class="material-icons" aria-hidden="true" id="themeIcon">dark_mode</span>
        </button>
        <button id="notifBtn" aria-label="View notifications" aria-haspopup="true" aria-expanded="false">
          <span class="material-icons" aria-hidden="true">notifications</span>
          <span class="notification-dot" aria-hidden="true"></span>
        </button>
        <button id="userBtn" aria-label="User menu" aria-haspopup="true" aria-expanded="false">
          <span class="material-icons" aria-hidden="true">person</span>
        </button>
      </nav>
    </header>
    <main id="main-content" tabindex="-1" role="main">
      <form id="fineForm" novalidate aria-live="polite" aria-describedby="formInstructions">
        <h2 id="formInstructions">Fine Checker Form</h2>
        <div class="form-row">
          <div class="form-group">
            <label for="fineDate">Date of Fine</label>
            <input
              type="date"
              id="fineDate"
              name="fineDate"
              required
              aria-required="true"
              aria-describedby="fineDateError"
            />
            <div class="error-message" role="alert" id="fineDateError" aria-live="assertive"></div>
          </div>
          <div class="form-group">
            <label for="fineCost">Fine Cost (USD)</label>
            <input
              type="text"
              id="fineCost"
              name="fineCost"
              inputmode="decimal"
              pattern="^\d+(\.\d{1,2})?$"
              placeholder="e.g. 50.00"
              required
              aria-required="true"
              aria-describedby="fineCostError"
            />
            <div class="error-message" role="alert" id="fineCostError" aria-live="assertive"></div>
          </div>
        </div>
        <div class="form-group">
          <label for="fineDetail">Fine Details</label>
          <textarea
            id="fineDetail"
            name="fineDetail"
            rows="3"
            maxlength="500"
            placeholder="Detailed description of the fine"
            aria-describedby="fineDetailDesc"
          ></textarea>
          <div id="fineDetailDesc" style="font-size: 0.75rem; color: #9ca3af;">Max 500 characters</div>
          <div class="error-message" role="alert" id="fineDetailError" aria-live="assertive"></div>
        </div>
        <div class="form-group">
          <label for="fineData">Fine Data</label>
          <input
            type="text"
            id="fineData"
            name="fineData"
            placeholder="Additional data or reference"
            maxlength="100"
            aria-describedby="fineDataDesc"
          />
          <div id="fineDataDesc" style="font-size: 0.75rem; color: #9ca3af;">Optional additional data field</div>
          <div class="error-message" role="alert" id="fineDataError" aria-live="assertive"></div>
        </div>
        <div class="form-group">
          <label for="paymentStatus">Payment Status</label>
          <select
            id="paymentStatus"
            name="paymentStatus"
            required
            aria-required="true"
            aria-describedby="paymentStatusError"
          >
            <option disabled value="">Select status</option>
            <option value="paid">Paid</option>
            <option value="unpaid">Unpaid</option>
            <option value="pending">Pending</option>
          </select>
          <div class="error-message" role="alert" id="paymentStatusError" aria-live="assertive"></div>
        </div>
        <button type="submit" aria-describedby="submitHelp" id="submitBtn" disabled>Save Fine</button>
        <div id="submitHelp" style="font-size: 0.75rem; color: #9ca3af; margin-top: -12px;">
          Fill all required fields to enable save.
        </div>
      </form>

      <section aria-label="Saved fines table section" style="max-width: 900px; margin: 2rem auto;">
        <h2 style="color:#a5b4fc; text-align:center;">Saved Fines</h2>
        <table id="fineTable" aria-live="polite" aria-relevant="additions removals">
          <thead>
            <tr>
              <th>Date</th>
              <th>Cost (USD)</th>
              <th>Details</th>
              <th>Data</th>
              <th>Status</th>
              <th aria-label="Actions column"></th>
            </tr>
          </thead>
          <tbody>
            <!-- Generated dynamically -->
          </tbody>
        </table>
      </section>
    </main>
    <footer id="footer" role="contentinfo">
      <span>&copy; 2024 FineCheck Inc. All rights reserved.</span>
    </footer>
  </div>

  <div id="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <span class="material-icons" id="toastIcon" aria-hidden="true">check_circle</span>
    <div id="toastMessage">Success message</div>
  </div>

  <script>
    (() => {
      const form = document.getElementById('fineForm');
      const submitBtn = document.getElementById('submitBtn');
      const toast = document.getElementById('toast');
      const toastMessage = document.getElementById('toastMessage');
      const toastIcon = document.getElementById('toastIcon');

      const inputs = {
        fineDate: form.elements.fineDate,
        fineCost: form.elements.fineCost,
        fineDetail: form.elements.fineDetail,
        fineData: form.elements.fineData,
        paymentStatus: form.elements.paymentStatus,
      };

      const errors = {
        fineDate: document.getElementById('fineDateError'),
        fineCost: document.getElementById('fineCostError'),
        fineDetail: document.getElementById('fineDetailError'),
        fineData: document.getElementById('fineDataError'),
        paymentStatus: document.getElementById('paymentStatusError'),
      };

      let storedFines = [];

      const PATTERNS = {
        cost: /^\d+(\.\d{1,2})?$/,
      };

      function showToast(message, type = 'success') {
        toastMessage.textContent = message;
        toast.className = 'show ' + type;
        toastIcon.textContent = type === 'success' ? 'check_circle' : 'error';
        setTimeout(() => {
          toast.className = '';
        }, 3500);
      }

      function validateField(field) {
        let valid = true;
        let msg = '';
        switch (field) {
          case 'fineDate':
            if (!inputs.fineDate.value) {
              msg = 'Date of Fine is required.';
              valid = false;
            }
            break;
          case 'fineCost':
            if (!inputs.fineCost.value) {
              msg = 'Fine Cost is required.';
              valid = false;
            } else if (!PATTERNS.cost.test(inputs.fineCost.value.trim())) {
              msg = 'Fine Cost format invalid; allow up to 2 decimals.';
              valid = false;
            }
            break;
          case 'paymentStatus':
            if (!inputs.paymentStatus.value) {
              msg = 'Payment Status is required.';
              valid = false;
            }
            break;
          case 'fineDetail':
            if (inputs.fineDetail.value.length > 500) {
              msg = 'Fine Details cannot exceed 500 characters.';
              valid = false;
            }
            break;
          case 'fineData':
            if (inputs.fineData.value.length > 100) {
              msg = 'Fine Data cannot exceed 100 characters.';
              valid = false;
            }
            break;
        }
        errors[field].textContent = msg;
        return valid;
      }

      function validateForm() {
        let formValid = true;
        for (const field in inputs) {
          if (!validateField(field)) formValid = false;
        }
        submitBtn.disabled = !formValid;
        return formValid;
      }

      function resetForm() {
        form.reset();
        for (const field in errors) {
          errors[field].textContent = '';
        }
        submitBtn.disabled = true;
        inputs.fineDate.focus();
      }

      function renderTable() {
        const tbody = document.querySelector('#fineTable tbody');
        tbody.innerHTML = '';
        storedFines.forEach((fine, i) => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>${fine.fineDate}</td>
            <td>$${parseFloat(fine.fineCost).toFixed(2)}</td>
            <td>${fine.fineDetail || '-'}</td>
            <td>${fine.fineData || '-'}</td>
            <td>${fine.paymentStatus.charAt(0).toUpperCase() + fine.paymentStatus.slice(1)}</td>
            <td class="actions" aria-label="Actions">
              <button aria-label="Edit fine at row ${i + 1}" data-index="${i}" class="edit-btn" title="Edit">
                <span class="material-icons">edit</span>
              </button>
              <button aria-label="Delete fine at row ${i + 1}" data-index="${i}" class="delete-btn" title="Delete">
                <span class="material-icons">delete</span>
              </button>
            </td>
          `;
          tbody.appendChild(tr);
        });
      }

      function saveData() {
        localStorage.setItem('fineCheckerData', JSON.stringify(storedFines));
      }

      function loadData() {
        const data = localStorage.getItem('fineCheckerData');
        if (data) {
          storedFines = JSON.parse(data);
          renderTable();
        }
      }

      // Optimistic UI update + validation + notifications
      form.addEventListener('input', () => {
        validateForm();
      });

      form.addEventListener('submit', (e) => {
        e.preventDefault();
        if (!validateForm()) return;

        const newFine = {
          fineDate: inputs.fineDate.value,
          fineCost: inputs.fineCost.value.trim(),
          fineDetail: inputs.fineDetail.value.trim(),
          fineData: inputs.fineData.value.trim(),
          paymentStatus: inputs.paymentStatus.value,
        };

        // Optimistic update
        storedFines.push(newFine);
        renderTable();
        saveData();
        resetForm();
        showToast('Fine saved successfully.');

      });

      // Edit and Delete handlers
      document.querySelector('#fineTable tbody').addEventListener('click', (e) => {
        const target = e.target.closest('button');
        if (!target) return;
        const idx = target.dataset.index;
        if (target.classList.contains('edit-btn')) {
          const fine = storedFines[idx];
          inputs.fineDate.value = fine.fineDate;
          inputs.fineCost.value = fine.fineCost;
          inputs.fineDetail.value = fine.fineDetail;
          inputs.fineData.value = fine.fineData;
          inputs.paymentStatus.value = fine.paymentStatus;
          submitBtn.disabled = false;
          // Remove fine from array for edit save replace
          storedFines.splice(idx, 1);
          renderTable();
          inputs.fineDate.focus();
          showToast('Edit mode enabled. Update fields and save.', 'info');
        } else if (target.classList.contains('delete-btn')) {
          if (
            confirm('Are you sure you want to delete this fine? This action cannot be undone.')
          ) {
            storedFines.splice(idx, 1);
            renderTable();
            saveData();
            showToast('Fine deleted.', 'success');
          }
        }
      });

      // Sidebar toggle for mobile
      const sidebar = document.getElementById('sidebar');
      const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');

      sidebarToggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        const expanded = sidebar.classList.contains('open');
        sidebarToggleBtn.setAttribute('aria-expanded', expanded);
      });

      // Theme toggler
      const themeToggleBtn = document.getElementById('themeToggle');
      const themeIcon = document.getElementById('themeIcon');
      let darkTheme = true;

      function applyTheme() {
        if (darkTheme) {
          document.documentElement.style.setProperty('--bg-color', '#1e1e2f');
          document.body.style.background = '#1e1e2f';
          themeIcon.textContent = 'dark_mode';
        } else {
          document.documentElement.style.setProperty('--bg-color', '#fff');
          document.body.style.background = '#fff';
          themeIcon.textContent = 'light_mode';
        }
      }

      themeToggleBtn.addEventListener('click', () => {
        darkTheme = !darkTheme;
        if (darkTheme) {
          document.body.style.color = '#e0e0e8';
          applyTheme();
          document.getElementById('app').style.background = 'linear-gradient(135deg, #20202d 0%, #2c2c40 100%)';
        } else {
          document.body.style.color = '#222222';
          document.getElementById('app').style.background = 'linear-gradient(135deg, #f0f0f3 0%, #d6d6e5 100%)';
          applyTheme();
        }
      });

      // Initial load
      window.addEventListener('load', () => {
        loadData();
        validateForm();
        sidebarToggleBtn.setAttribute('aria-expanded', false);
      });
    })();
  </script>
</body>
</html>