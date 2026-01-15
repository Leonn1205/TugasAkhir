<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Explore Kotabaru - Discover Hidden Paradise</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles & Libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background: #f8f5f0;
        }

        /* Navbar Transparan */
        .navbar-custom {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 1.5rem 3rem;
            background: rgba(34, 87, 50, 0.3);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .navbar-custom.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            padding: 1rem 3rem;
        }

        .navbar-custom .navbar-brand {
            color: white;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-custom.scrolled .navbar-brand,
        .navbar-custom.scrolled .nav-link {
            color: #1b5e20 !important;
        }

        .navbar-custom .nav-link {
            color: white;
            font-weight: 500;
            margin: 0 1rem;
            transition: all 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            color: #ffd54f !important;
        }

        .btn-explore {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            padding: 0.7rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-explore:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(46, 125, 50, 0.4);
        }

        /* Hero Section */
        .hero-section {
            height: 100vh;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)),
                url('{{ asset('images/bg-login.png') }}') center/cover;
            animation: zoomIn 20s infinite alternate;
        }

        @keyframes zoomIn {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.1);
            }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            max-width: 900px;
            padding: 0 2rem;
        }

        .hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 72px;
            font-weight: 900;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 1s ease;
        }

        .hero-content p {
            font-size: 22px;
            margin-bottom: 2.5rem;
            font-weight: 300;
            letter-spacing: 1px;
            animation: fadeInUp 1.2s ease;
        }

        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            animation: fadeInUp 1.4s ease;
        }

        .btn-hero {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all 0.4s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-hero {
            background: white;
            color: #1b5e20;
        }

        .btn-primary-hero:hover {
            background: #ffd54f;
            color: #1b5e20;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 213, 79, 0.4);
        }

        .btn-secondary-hero {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary-hero:hover {
            background: white;
            color: #1a1a1a;
            transform: translateY(-3px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            animation: bounce 2s infinite;
        }

        .scroll-indicator i {
            color: white;
            font-size: 32px;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            50% {
                transform: translateX(-50%) translateY(10px);
            }
        }

        /* Section Styling */
        section {
            padding: 100px 0;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            color: #1b5e20;
        }

        .section-subtitle {
            text-align: center;
            font-size: 18px;
            color: #2e7d32;
            max-width: 600px;
            margin: 0 auto 4rem;
        }

        /* Quick Search */
        .quick-search {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            padding: 80px 0;
        }

        .search-box {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 60px;
            padding: 1rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            display: flex;
            gap: 1rem;
        }

        .search-box input {
            flex: 1;
            border: none;
            padding: 1rem 2rem;
            font-size: 16px;
            outline: none;
        }

        .search-box select {
            border: none;
            padding: 1rem;
            font-size: 16px;
            background: transparent;
            outline: none;
            cursor: pointer;
        }

        .search-box button {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-box button:hover {
            transform: scale(1.05);
        }

        /* Destination Cards */
        .destination-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            height: 400px;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .destination-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .destination-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.4s ease;
        }

        .destination-card:hover img {
            transform: scale(1.1);
        }

        .destination-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            padding: 2rem;
            color: white;
        }

        .destination-overlay h3 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .destination-overlay p {
            font-size: 14px;
            opacity: 0.9;
        }

        .destination-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 213, 79, 0.95);
            color: #1b5e20;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Map Section */
        .map-section {
            background: #e8f5e9;
        }

        #interactiveMap {
            height: 600px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .map-controls {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            height: 600px;
            overflow-y: auto;
        }

        .map-controls::-webkit-scrollbar {
            width: 8px;
        }

        .map-controls::-webkit-scrollbar-thumb {
            background: #388e3c;
            border-radius: 10px;
        }

        .filter-group {
            margin-bottom: 1.5rem;
        }

        .filter-group label {
            font-weight: 600;
            color: #1b5e20;
            margin-bottom: 0.5rem;
            display: block;
        }

        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #c8e6c9;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            border-color: #388e3c;
            outline: none;
        }

        .place-list {
            margin-top: 1.5rem;
        }

        .place-item {
            padding: 1rem;
            background: #ffffff;
            border-radius: 10px;
            margin-bottom: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #c8e6c9;
        }

        .place-item:hover {
            background: #388e3c;
            color: white;
            transform: translateX(5px);
            border-color: #388e3c;
        }

        .place-item h6 {
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .place-item small {
            opacity: 0.8;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: white;
            text-align: center;
        }

        .stat-item {
            padding: 2rem;
        }

        .stat-item i {
            font-size: 48px;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .stat-item h2 {
            font-size: 52px;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-item p {
            font-size: 18px;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Footer */
        footer {
            background: #1a1a1a;
            color: white;
            padding: 3rem 0 1.5rem;
        }

        footer h5 {
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        footer a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: #ffd700;
            padding-left: 5px;
        }

        .social-links a {
            display: inline-block;
            margin-right: 1rem;
            font-size: 24px;
        }

        /* Search Results Dropdown */
        #searchResults {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 20px;
            margin-top: 0.5rem;
            max-height: 300px;
            overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 100;
        }

        .search-result-item {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-result-item:hover {
            background: #f8f9fa;
            padding-left: 2rem;
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 42px;
            }

            .hero-content p {
                font-size: 18px;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .section-title {
                font-size: 36px;
            }

            .navbar-custom {
                padding: 1rem;
            }

            .search-box {
                flex-direction: column;
            }
        }

        /* Place Details Modal - Updated Style */
        .place-details-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 400px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            z-index: 10001;
            animation: modalFadeIn 0.3s ease;
            overflow: hidden;
        }

        .place-details-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 10000;
            animation: fadeIn 0.3s ease;
            backdrop-filter: blur(5px);
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .place-details-header {
            position: relative;
            height: 200px;
            overflow: hidden;
            background: #f0f0f0;
        }

        .place-details-header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .place-details-close {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 32px;
            height: 32px;
            background: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 20px;
            color: #333;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            z-index: 10;
        }

        .place-details-close:hover {
            background: #f44336;
            color: white;
            transform: rotate(90deg);
        }

        .place-details-content {
            padding: 1.5rem;
        }

        .place-details-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 1rem;
            text-align: left;
        }

        .place-details-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .place-tag {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 0.4rem 0.8rem;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .place-details-description {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }

        .place-details-footer {
            padding: 0 1.5rem 1.5rem;
        }

        .btn-view-details {
            width: 100%;
            background: #1976D2;
            color: white;
            padding: 0.9rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-view-details:hover {
            background: #1565C0;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 118, 210, 0.4);
            color: white;
        }

        /* Responsive untuk Modal */
        @media (max-width: 768px) {
            .place-details-modal {
                width: 95%;
                max-width: none;
            }

            .place-details-header {
                height: 180px;
            }

            .place-details-content {
                padding: 1.2rem;
            }

            .place-details-title {
                font-size: 20px;
            }

            .place-details-footer {
                padding: 0 1.2rem 1.2rem;
            }
        }

        /* === STATS SECTION MOBILE === */
        @media (max-width: 768px) {
            .stats-section {
                padding: 40px 0 !important;
            }

            .stats-section .container {
                padding: 0 15px !important;
            }

            .stats-section .row {
                margin: 0 !important;
                display: flex !important;
                flex-direction: row !important;
                gap: 0 !important;
            }

            .stats-section .col-md-6 {
                width: 50% !important;
                flex: 0 0 50% !important;
                max-width: 50% !important;
                padding: 0 !important;
            }

            .stat-item {
                padding: 1.5rem 0.5rem !important;
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
            }

            .stat-item i {
                font-size: 32px !important;
                margin-bottom: 0.6rem !important;
                opacity: 0.95 !important;
            }

            .stat-item h2 {
                font-size: 36px !important;
                margin-bottom: 0.3rem !important;
                font-weight: 700 !important;
                line-height: 1 !important;
            }

            .stat-item p {
                font-size: 12px !important;
                letter-spacing: 1px !important;
                opacity: 0.9 !important;
                margin-bottom: 0 !important;
                text-transform: uppercase !important;
            }
        }

        /* Extra small phones */
        @media (max-width: 375px) {
            .stat-item {
                padding: 1.2rem 0.3rem !important;
            }

            .stat-item i {
                font-size: 28px !important;
            }

            .stat-item h2 {
                font-size: 32px !important;
            }

            .stat-item p {
                font-size: 11px !important;
            }
        }

        < !-- GANTI SEMUA CSS MOBILE RESPONSIVE yang lama dengan yang ini -->< !-- Letakkan di AKHIR tag <style>Anda,
        sebelum
    </style> -->

    <style>
        /* ========================================
   COMPLETE MOBILE RESPONSIVE OVERHAUL
   ======================================== */

        /* === GLOBAL MOBILE FIXES === */
        @media (max-width: 768px) {

            /* Prevent horizontal scroll */
            body {
                overflow-x: hidden !important;
                width: 100%;
            }

            .container-fluid {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }

            /* All sections */
            section {
                padding: 40px 0 !important;
            }

            /* Force navbar elements to show */
            .navbar-toggler,
            .navbar-toggler-icon {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
            }
        }

        /* === NAVBAR MOBILE === */
        @media (max-width: 768px) {

            /* Force consistent navbar */
            .navbar-custom {
                padding: 0.7rem 15px !important;
                background: rgba(27, 94, 32, 0.95) !important;
                position: fixed !important;
                width: 100% !important;
                top: 0 !important;
                z-index: 1000 !important;
            }

            .navbar-custom.scrolled {
                padding: 0.6rem 15px !important;
                background: rgba(255, 255, 255, 0.98) !important;
            }

            /* Brand */
            .navbar-brand {
                font-size: 15px !important;
                gap: 8px !important;
                display: flex !important;
                align-items: center !important;
            }

            .navbar-brand img {
                height: 26px !important;
                display: block !important;
            }

            /* Navbar toggler - Always visible */
            .navbar-toggler {
                border: 2px solid white !important;
                padding: 0.3rem 0.5rem !important;
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
            }

            .navbar-custom.scrolled .navbar-toggler {
                border-color: #1b5e20 !important;
            }

            .navbar-toggler:focus {
                box-shadow: none !important;
                outline: none !important;
            }

            .navbar-toggler-icon {
                width: 18px !important;
                height: 18px !important;
                display: block !important;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='white' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
            }

            .navbar-custom.scrolled .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%231b5e20' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
            }

            /* Collapse menu */
            .navbar-collapse {
                background: rgba(27, 94, 32, 0.98) !important;
                margin-top: 0.8rem !important;
                padding: 0.8rem !important;
                border-radius: 12px !important;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3) !important;
            }

            .navbar-custom.scrolled .navbar-collapse {
                background: white !important;
                border: 2px solid #1b5e20 !important;
            }

            .navbar-nav {
                gap: 0.3rem !important;
            }

            .nav-link {
                padding: 0.65rem 1rem !important;
                border-radius: 8px !important;
                text-align: center !important;
                font-size: 14px !important;
                display: block !important;
            }

            .nav-link:hover {
                background: rgba(255, 255, 255, 0.1) !important;
            }

            .navbar-custom.scrolled .nav-link:hover {
                background: #e8f5e9 !important;
            }
        }

        /* === HERO SECTION MOBILE === */
        @media (max-width: 768px) {
            .hero-section {
                height: 100vh;
                min-height: 600px;
            }

            .hero-content {
                padding: 0 20px;
            }

            .hero-content h1 {
                font-size: 36px !important;
                line-height: 1.2;
                margin-bottom: 1rem;
            }

            .hero-content p {
                font-size: 16px !important;
                line-height: 1.4;
                margin-bottom: 2rem;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 1rem;
                width: 100%;
                max-width: 300px;
                margin: 0 auto;
            }

            .btn-hero {
                width: 100%;
                padding: 1rem 2rem;
                font-size: 15px;
            }

            .scroll-indicator {
                bottom: 20px;
            }

            .scroll-indicator i {
                font-size: 24px;
            }
        }

        /* Extra small phones */
        @media (max-width: 375px) {
            .hero-content h1 {
                font-size: 28px !important;
            }

            .hero-content p {
                font-size: 14px !important;
            }
        }

        /* === SECTION TITLES MOBILE === */
        @media (max-width: 768px) {
            .section-title {
                font-size: 28px !important;
                padding: 0 15px;
                margin-bottom: 0.6rem !important;
                line-height: 1.2;
            }

            .section-subtitle {
                font-size: 14px !important;
                padding: 0 15px;
                margin-bottom: 1.5rem !important;
                line-height: 1.4;
            }
        }

        @media (max-width: 375px) {
            .section-title {
                font-size: 24px !important;
            }

            .section-subtitle {
                font-size: 13px !important;
            }
        }

        /* === QUICK SEARCH MOBILE === */
        @media (max-width: 768px) {
            .quick-search {
                padding: 50px 0;
            }

            .search-box {
                flex-direction: column;
                padding: 1rem;
                border-radius: 25px;
                margin: 0 15px;
                gap: 0.8rem;
            }

            .search-box input,
            .search-box select {
                padding: 0.9rem 1.2rem;
                font-size: 15px;
                border-radius: 12px;
                width: 100%;
                border: 1px solid #e0e0e0;
            }

            .search-box button {
                width: 100%;
                padding: 1rem;
                font-size: 15px;
            }
        }

        /* === DESTINATION CARDS MOBILE === */
        @media (max-width: 768px) {
            .row.g-4 {
                --bs-gutter-x: 0.8rem;
                --bs-gutter-y: 0.8rem;
                margin: 0 !important;
            }

            /* Cards container */
            #destinations .row,
            #culinary .row {
                padding: 0 15px;
            }

            /* Main card styling - LEBIH KECIL */
            .destination-card {
                height: 160px !important;
                border-radius: 12px;
                margin-bottom: 0.5rem;
            }

            .destination-card img {
                object-fit: cover;
                width: 100%;
                height: 100%;
            }

            .destination-overlay {
                padding: 0.7rem 0.8rem !important;
                background: linear-gradient(to top, rgba(0, 0, 0, 0.88), transparent) !important;
            }

            .destination-overlay h3 {
                font-size: 14px !important;
                margin-bottom: 0.15rem !important;
                line-height: 1.2 !important;
                font-weight: 600 !important;
            }

            .destination-overlay p {
                font-size: 10px !important;
                margin-bottom: 0 !important;
                opacity: 0.95;
            }

            .destination-badge {
                top: 8px !important;
                right: 8px !important;
                padding: 0.3rem 0.6rem !important;
                font-size: 9px !important;
                border-radius: 10px !important;
                font-weight: 600;
            }

            /* Fix button centering */
            .text-center .btn-hero {
                margin: 1rem auto 0 !important;
                max-width: 260px !important;
                display: block !important;
                padding: 0.85rem 1.8rem !important;
                font-size: 14px !important;
            }
        }

        /* Extra small phones - LEBIH KECIL LAGI */
        @media (max-width: 375px) {
            .destination-card {
                height: 140px !important;
            }

            .destination-overlay {
                padding: 0.6rem 0.7rem !important;
            }

            .destination-overlay h3 {
                font-size: 13px !important;
            }

            .destination-overlay p {
                font-size: 9px !important;
            }

            .destination-badge {
                padding: 0.25rem 0.5rem !important;
                font-size: 8px !important;
            }
        }

        /* === STATS SECTION MOBILE === */
        @media (max-width: 768px) {
            .stats-section {
                padding: 50px 0 !important;
            }

            .stat-item {
                padding: 1.5rem;
            }

            .stat-item i {
                font-size: 40px !important;
                margin-bottom: 0.8rem;
            }

            .stat-item h2 {
                font-size: 42px !important;
                margin-bottom: 0.3rem;
            }

            .stat-item p {
                font-size: 15px !important;
                letter-spacing: 1px;
            }
        }

        /* === MAP SECTION MOBILE === */
        @media (max-width: 768px) {
            .map-section {
                padding: 50px 0 !important;
            }

            /* Map columns - stack vertically */
            .map-section .row {
                flex-direction: column-reverse;
            }

            .map-section .col-lg-3,
            .map-section .col-lg-9 {
                width: 100%;
                padding: 0 15px;
            }

            /* Map controls */
            .map-controls {
                height: auto !important;
                max-height: none;
                padding: 1.2rem;
                margin-top: 1rem;
                border-radius: 15px;
            }

            .filter-group {
                margin-bottom: 1rem;
            }

            .filter-group label {
                font-size: 13px;
                margin-bottom: 0.4rem;
            }

            .filter-group select,
            .filter-group input {
                padding: 0.7rem;
                font-size: 14px;
                border-radius: 8px;
            }

            .btn-explore {
                padding: 0.8rem 1.5rem;
                font-size: 14px;
                margin-bottom: 1rem !important;
            }

            /* Place list */
            .place-list h6 {
                font-size: 14px;
                margin-bottom: 0.8rem !important;
            }

            .place-item {
                padding: 0.9rem;
                margin-bottom: 0.6rem;
                border-radius: 8px;
            }

            .place-item h6 {
                font-size: 14px;
                margin-bottom: 0.2rem;
            }

            .place-item small {
                font-size: 12px;
            }

            /* Map itself */
            #interactiveMap {
                height: 350px !important;
                border-radius: 15px;
                margin-bottom: 0;
            }
        }

        @media (max-width: 375px) {
            #interactiveMap {
                height: 300px !important;
            }

            .map-controls {
                padding: 1rem;
            }
        }

        /* === FOOTER MOBILE === */
        @media (max-width: 768px) {
            footer {
                padding: 2.5rem 0 1.5rem;
            }

            footer .row>div {
                margin-bottom: 2rem;
                text-align: center;
            }

            footer h5 {
                font-size: 17px;
                margin-bottom: 1rem;
            }

            footer p,
            footer a {
                font-size: 14px;
            }

            footer a:hover {
                padding-left: 0;
            }

            .social-links {
                justify-content: center;
                display: flex;
                gap: 1rem;
            }

            .social-links a {
                font-size: 22px;
                margin: 0;
            }
        }

        /* === MODAL MOBILE === */
        @media (max-width: 768px) {
            .place-details-modal {
                width: 92% !important;
                max-width: none !important;
                border-radius: 20px;
            }

            .place-details-header {
                height: 180px !important;
                border-radius: 20px 20px 0 0;
            }

            .place-details-close {
                width: 36px;
                height: 36px;
                font-size: 22px;
            }

            .place-details-content {
                padding: 1.3rem;
            }

            .place-details-title {
                font-size: 20px !important;
                margin-bottom: 0.8rem;
            }

            .place-tag {
                font-size: 11px;
                padding: 0.4rem 0.7rem;
            }

            .place-details-description {
                font-size: 13px;
                margin-bottom: 1.2rem;
            }

            .place-details-footer {
                padding: 0 1.3rem 1.3rem;
            }

            .btn-view-details {
                padding: 1rem;
                font-size: 14px;
                border-radius: 10px;
            }
        }

        /* === LANDSCAPE MODE FIXES === */
        @media (max-width: 768px) and (orientation: landscape) {
            .hero-section {
                height: auto;
                min-height: 100vh;
                padding: 120px 0 60px;
            }

            .hero-content h1 {
                font-size: 32px !important;
            }

            .hero-content p {
                font-size: 14px !important;
                margin-bottom: 1.5rem;
            }

            .scroll-indicator {
                display: none;
            }

            #interactiveMap {
                height: 300px !important;
            }
        }

        /* === PREVENT OVERFLOW === */
        @media (max-width: 768px) {

            .container,
            .container-fluid {
                max-width: 100%;
                overflow-x: hidden;
            }

            img {
                max-width: 100%;
                height: auto;
            }

            /* Fix Bootstrap container */
            .container-fluid.px-5 {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }
        }

        /* === TOUCH IMPROVEMENTS === */
        @media (max-width: 768px) {

            /* Larger tap targets */
            .btn,
            .btn-hero,
            .btn-explore,
            .btn-view-details,
            .place-item {
                min-height: 48px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Smooth scrolling on mobile */
            html {
                scroll-behavior: smooth;
            }

            /* Remove hover effects on touch devices */
            .destination-card:hover {
                transform: none;
            }

            .destination-card:active {
                transform: scale(0.98);
            }
        }

        /* === FIX SPACING ISSUES === */
        @media (max-width: 768px) {

            /* Remove extra margins */
            .mb-4 {
                margin-bottom: 1.5rem !important;
            }

            .mb-3 {
                margin-bottom: 1rem !important;
            }

            /* Consistent padding */
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
                KOTABARU
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#destinations">Destinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#culinary">Culinary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#map">Explore Map</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-bg"></div>
        <div class="hero-content">
            <h1>Discover Kotabaru</h1>
            <p>Heritage Garden City - Where Colonial Charm Meets Yogyakarta's Soul</p>
            <div class="hero-buttons">
                <a href="#destinations" class="btn-hero btn-primary-hero">
                    Explore Destinations
                </a>
                <a href="#map" class="btn-hero btn-secondary-hero">
                    View Map
                </a>
            </div>
        </div>
        <div class="scroll-indicator">
            <i class="bi bi-chevron-down"></i>
        </div>
    </section>

    <!-- Destinations Section -->
    <section id="destinations">
        <div class="container">
            <h2 class="section-title">Top Destinations</h2>
            <p class="section-subtitle">Explore the most beautiful places in Kotabaru, from colonial heritage buildings
                to lush green parks</p>

            <div class="row g-4 mb-4">
                @foreach ($wisata->take(6) as $index => $w)
                    <div class="col-md-4">
                        <div class="destination-card"
                            onclick="showOnMap({{ $w->latitude }}, {{ $w->longitude }}, 'wisata')">
                            @if ($w->foto->count() > 0)
                                {{-- TEST: Hardcode URL untuk debugging --}}
                                @php
                                    $fotoUrl = asset('storage/' . $w->foto->first()->path_foto);
                                @endphp
                                <img src="{{ $fotoUrl }}" alt="{{ $w->nama_wisata }}"
                                    onerror="console.error('Failed to load:', this.src); this.src='https://placehold.co/800x600/2196F3/FFFFFF?text=Error'">
                            @else
                                <img src="https://placehold.co/800x600/2196F3/FFFFFF?text=No+Image"
                                    alt="{{ $w->nama_wisata }}">
                            @endif
                            <div class="destination-badge"
                                style="background: rgba(33, 150, 243, 0.95); color: #ffffff;">
                                <i class="bi bi-geo-alt-fill me-1"></i>Tourism


                            </div>
                            <div class="destination-overlay">
                                <h3>{{ $w->nama_wisata }}</h3>
                                <p><i class="bi bi-pin-map me-1"></i>Kotabaru, Yogyakarta</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="#map" class="btn-hero btn-primary-hero">
                    View All Destinations <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Culinary Section -->
    <section id="culinary" style="background: #f5f1e8;">
        <div class="container">
            <h2 class="section-title">Local Culinary</h2>
            <p class="section-subtitle">Taste the authentic flavors of Kotabaru's traditional and modern cuisine</p>

            <div class="row g-4 mb-4">
                @if ($kulinerFiltered && $kulinerFiltered->count() > 0)
                    @foreach ($kulinerFiltered->take(6) as $k)
                        <div class="col-md-4">
                            <div class="destination-card"
                                onclick="showOnMap({{ $k->latitude }}, {{ $k->longitude }}, 'kuliner')">
                                @if ($k->foto->count() > 0)
                                    {{-- ✅ GUNAKAN url_foto dari accessor --}}
                                    <img src="{{ $k->foto->first()->url_foto }}" alt="{{ $k->nama_sentra }}"
                                        onerror="this.src='https://placehold.co/800x600/FF5722/FFFFFF?text=Culinary+Spot'">
                                @else
                                    <img src="https://placehold.co/800x600/FF5722/FFFFFF?text=No+Image"
                                        alt="{{ $k->nama_sentra }}">
                                @endif
                                <div class="destination-badge"
                                    style="background: rgba(212, 55, 55, 0.95); color: #ffffff;">
                                    <i class="bi bi-cup-hot-fill me-1"></i>Culinary
                                </div>
                                <div class="destination-overlay">
                                    <h3>{{ $k->nama_sentra }}</h3>
                                    <p><i class="bi bi-star-fill me-1"></i>Local Favorite</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>Tidak ada data kuliner tersedia</p>
                    </div>
                @endif
            </div>

            <div class="text-center">
                <a href="#map" class="btn-hero btn-primary-hero">
                    Explore More Culinary <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="stat-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <h2>{{ $wisata->count() }}</h2>
                        <p>Destinations</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-item">
                        <i class="bi bi-cup-hot-fill"></i>
                        <h2>{{ $kulinerFiltered->count() }}</h2>
                        <p>Culinary Spots</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Map Section -->
    <section id="map" class="map-section">
        <div class="container-fluid px-5">
            <h2 class="section-title">Explore Interactive Map</h2>
            <p class="section-subtitle">Find the perfect destination near you with our interactive map</p>

            <div class="row g-4">
                <div class="col-lg-3">
                    <div class="map-controls">
                        <div class="filter-group">
                            <label><i class="bi bi-search me-2"></i>Search Location</label>
                            <input type="text" id="mapSearch" placeholder="Search..." onkeyup="searchOnMap()">
                        </div>

                        <div class="filter-group">
                            <label><i class="bi bi-funnel me-2"></i>Filter Tourism</label>
                            <select id="wisataFilter" onchange="filterWisata()">
                                <option value="semua">All Categories</option>
                                @foreach ($kategoriWisataList as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label><i class="bi bi-funnel me-2"></i>Filter Culinary</label>
                            <select id="kulinerFilter" onchange="filterKuliner()">
                                <option value="semua">All Categories</option>
                                @foreach ($kategoriKulinerList as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-explore w-100 mb-3" onclick="getNearby()">
                            <i class="bi bi-compass me-2"></i>Find Nearby
                        </button>

                        <div class="place-list">
                            <h6 class="fw-bold mb-3">Featured Places</h6>

                            <!-- Wisata -->
                            @foreach ($wisata->take(3) as $w)
                                <div class="place-item"
                                    onclick="showPlaceDetails({{ $w->latitude }}, {{ $w->longitude }}, 'wisata', '{{ $w->id_wisata }}')">
                                    <h6><i class="bi bi-geo-alt-fill text-primary me-2"></i>{{ $w->nama_wisata }}</h6>
                                    <small><i class="bi bi-tag me-1"></i>Tourism Destination</small>
                                </div>
                            @endforeach

                            <!-- Kuliner -->
                            @foreach ($kulinerFiltered->take(3) as $k)
                                <div class="place-item"
                                    onclick="showPlaceDetails({{ $k->latitude }}, {{ $k->longitude }}, 'kuliner', '{{ $k->id_kuliner }}')">
                                    <h6><i class="bi bi-cup-hot-fill text-danger me-2"></i>{{ $k->nama_sentra }}</h6>
                                    <small><i class="bi bi-tag me-1"></i>Culinary Spot</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div id="interactiveMap"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Kotabaru Tourism</h5>
                    <p style="color: rgba(255,255,255,0.7);">Discover the hidden paradise of Kotabaru Yogyakarta.
                        Experience heritage, culture, and culinary delights.</p>
                    <div class="social-links mt-3">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Explore</h5>
                    <a href="#destinations">Destinations</a>
                    <a href="#culinary">Culinary</a>
                    <a href="#map">Map</a>
                    <a href="#">Events</a>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Information</h5>
                    <a href="#">About Kotabaru</a>
                    <a href="#">Travel Guide</a>
                    <a href="#">Contact Us</a>
                    <a href="#">FAQ</a>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Contact</h5>
                    <a href="#"><i class="bi bi-envelope me-2"></i>info@kotabaru-tourism.id</a>
                    <a href="#"><i class="bi bi-telephone me-2"></i>+62 123 4567 890</a>
                    <a href="#"><i class="bi bi-geo-alt me-2"></i>Kotabaru, Gondokusuman, Yogyakarta</a>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.1); margin: 2rem 0;">
            <div class="text-center" style="color: rgba(255,255,255,0.6);">
                <p class="mb-0">&copy; 2025 Kotabaru Tourism Data Center. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Initialize Map dengan koordinat Kotabaru Yogyakarta
        const map = L.map('interactiveMap').setView([-7.78694, 110.375], 15);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap &copy; CARTO',
            maxZoom: 20
        }).addTo(map);

        fetch('/geojson/kotabru.geojson')
            .then(res => res.json())
            .then(data => {
                var border = L.geoJSON(data, {
                    style: {
                        color: "#ff5500",
                        weight: 3,
                        fillOpacity: 0
                    }
                }).addTo(map);

                map.fitBounds(border.getBounds());
            });

        // Store markers
        let wisataMarkers = [];
        let kulinerMarkers = [];

        // ============================================================================
        // PERBAIKAN: Map Popup Images di welcome.blade.php
        // Ganti bagian Add Tourism Markers dan Add Culinary Markers
        // ============================================================================

        // Add Tourism Markers
        @foreach ($wisata as $w)
            @if ($w->latitude && $w->longitude)
                {
                    const wisataIcon = L.icon({
                        iconUrl: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });

                    const kategoriIds = [
                        @foreach ($w->kategoriAktif as $kat)
                            '{{ $kat->id_kategori }}',
                        @endforeach
                    ];

                    const marker = L.marker([{{ $w->latitude }}, {{ $w->longitude }}], {
                        icon: wisataIcon,
                        kategori: kategoriIds.join(','),
                        nama: '{{ addslashes($w->nama_wisata) }}',
                        tipe: 'wisata',
                        id: '{{ $w->id_wisata }}'
                    }).addTo(map);

                    // ✅ PERBAIKAN: Gunakan url_foto untuk popup
                    marker.bindPopup(`
                <div style="min-width: 200px;">
                    @if ($w->foto->count() > 0)
                        <img src="{{ $w->foto->first()->url_foto }}"
                            style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;"
                            onerror="this.src='https://placehold.co/800x600/2196F3/FFFFFF?text=No+Image'">
                    @else
                        <img src="https://placehold.co/800x600/2196F3/FFFFFF?text=No+Image"
                            style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
                    @endif
                    <h6 class="fw-bold mb-2">{{ $w->nama_wisata }}</h6>
                    <p class="mb-2 small">
                        <i class="bi bi-tag-fill me-1"></i>
                        @if ($w->kategoriAktif->count() > 0)
                            {{ $w->kategoriAktif->pluck('nama_kategori')->join(', ') }}
                        @else
                            Tourism
                        @endif
                    </p>
                    <a href="{{ route('user.wisata.show', $w->id_wisata) }}"
                       class="btn btn-sm btn-primary w-100"
                       style="text-decoration: none; color: white;">
                        View Details
                    </a>
                </div>
            `);

                    wisataMarkers.push(marker);
                }
            @endif
        @endforeach

        // Add Culinary Markers
        @foreach ($kulinerFiltered as $k)
            @if ($k->latitude && $k->longitude)
                {
                    const kulinerIcon = L.icon({
                        iconUrl: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });

                    const kategoriIds = [
                        @foreach ($k->kategoriAktif as $kat)
                            '{{ $kat->id_kategori }}',
                        @endforeach
                    ];

                    const marker = L.marker([{{ $k->latitude }}, {{ $k->longitude }}], {
                        icon: kulinerIcon,
                        kategori: kategoriIds.join(','),
                        nama: '{{ addslashes($k->nama_sentra) }}',
                        tipe: 'kuliner',
                        id: '{{ $k->id_kuliner }}'
                    }).addTo(map);

                    // ✅ PERBAIKAN: Gunakan url_foto untuk popup
                    marker.bindPopup(`
                <div style="min-width: 200px;">
                    @if ($k->foto->count() > 0)
                        <img src="{{ $k->foto->first()->url_foto }}"
                            style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;"
                            onerror="this.src='https://placehold.co/800x600/FF5722/FFFFFF?text=Culinary+Spot'">
                    @else
                        <img src="https://placehold.co/800x600/FF5722/FFFFFF?text=No+Image"
                            style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
                    @endif
                    <h6 class="fw-bold mb-2">{{ $k->nama_sentra }}</h6>
                    <p class="mb-2 small">
                        <i class="bi bi-cup-hot-fill me-1"></i>
                        @if ($k->kategoriAktif->count() > 0)
                            {{ $k->kategoriAktif->pluck('nama_kategori')->join(', ') }}
                        @else
                            Culinary
                        @endif
                    </p>
                    <a href="{{ route('user.kuliner.show', $k->id_kuliner) }}"
                       class="btn btn-sm btn-danger w-100"
                       style="text-decoration: none; color: white;">
                        View Details
                    </a>
                </div>
            `);

                    kulinerMarkers.push(marker);
                }
            @endif
        @endforeach

        // Show on Map Function
        function showOnMap(lat, lng, type) {
            const mapSection = document.getElementById('map');
            mapSection.scrollIntoView({
                behavior: 'smooth'
            });

            setTimeout(() => {
                map.setView([lat, lng], 16);

                if (type === 'wisata') {
                    wisataMarkers.forEach(marker => {
                        const latLng = marker.getLatLng();
                        if (latLng.lat === lat && latLng.lng === lng) {
                            marker.openPopup();
                        }
                    });
                } else {
                    kulinerMarkers.forEach(marker => {
                        const latLng = marker.getLatLng();
                        if (latLng.lat === lat && latLng.lng === lng) {
                            marker.openPopup();
                        }
                    });
                }
            }, 1000);
        }

        // Focus on Place
        function focusOnPlace(lat, lng) {
            map.setView([lat, lng], 16);
        }

        // Show Place Details - Open marker popup on map
        function showPlaceDetails(lat, lng, type, id) {
            // Scroll to map section
            const mapSection = document.getElementById('map');
            mapSection.scrollIntoView({
                behavior: 'smooth'
            });

            // Focus map and open popup after scroll
            setTimeout(() => {
                map.setView([lat, lng], 17);

                // Find the marker and open its popup
                const markers = type === 'wisata' ? wisataMarkers : kulinerMarkers;
                markers.forEach(marker => {
                    if (marker.options.id == id) {
                        // Close other popups first
                        map.closePopup();
                        // Open this marker's popup
                        marker.openPopup();
                    }
                });
            }, 800);
        }

        // Create Basic Modal (fallback when API not available)
        function createBasicModal(marker, type) {
            const isWisata = type === 'wisata';
            const data = {
                nama: marker.options.nama,
                id: marker.options.id,
                tipe: type
            };

            const detailUrl = isWisata ?
                `/wisata/${data.id}` :
                `/kuliner/${data.id}`;

            const overlay = document.createElement('div');
            overlay.className = 'place-details-overlay';
            overlay.onclick = closePlaceModal;

            const modal = document.createElement('div');
            modal.className = 'place-details-modal';
            modal.innerHTML = `
        <div class="place-details-header" style="background: linear-gradient(135deg, ${isWisata ? '#2196F3' : '#f44336'}, ${isWisata ? '#1565C0' : '#d32f2f'}); display: flex; align-items: center; justify-content: center;">
            <i class="bi ${isWisata ? 'bi-geo-alt-fill' : 'bi-cup-hot-fill'}" style="font-size: 60px; color: white;"></i>
            <button class="place-details-close" onclick="closePlaceModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <div class="place-details-content">
            <h3 class="place-details-title">${data.nama}</h3>
            <div class="place-details-tags">
                ${isWisata
                    ? '<span class="place-tag"><i class="bi bi-geo-alt-fill"></i>Tourism</span>'
                    : '<span class="place-tag" style="background: #fff3e0; color: #e65100;"><i class="bi bi-cup-hot-fill"></i>Culinary</span>'
                }
            </div>
            <p class="place-details-description">Click "View Details" to see full information about this place.</p>
        </div>
        <div class="place-details-footer">
            <a href="${detailUrl}" class="btn-view-details">
                <span>View Details</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    `;

            document.body.appendChild(overlay);
            document.body.appendChild(modal);
            document.body.style.overflow = 'hidden';
        }

        // Display Place Modal (with full data from API)
        function displayPlaceModal(data, type) {
            const isWisata = type === 'wisata';
            const nama = isWisata ? data.nama_wisata : data.nama_sentra;
            const idField = isWisata ? 'id_wisata' : 'id_kuliner';
            const placeId = data[idField] || data.id;

            let foto;
            if (data.foto && data.foto.length > 0) {
                const fotoPath = data.foto[0].path_foto;
                foto = `/storage/${fotoPath}`;
            } else {
                foto = isWisata ? '/images/default-heritage.jpg' : '/images/default-culinary.jpg';
            }

            const detailUrl = isWisata ?
                `/wisata/${data.id}` :
                `/kuliner/${data.id}`;

            let kategoriTags = '';
            if (data.kategori_aktif && data.kategori_aktif.length > 0) {
                kategoriTags = data.kategori_aktif.map(k =>
                    `<span class="place-tag">${k.nama_kategori}</span>`
                ).join('');
            }

            const deskripsi = data.deskripsi || data.description || '';
            const shortDesc = deskripsi.length > 100 ? deskripsi.substring(0, 100) + '...' : deskripsi;

            const overlay = document.createElement('div');
            overlay.className = 'place-details-overlay';
            overlay.onclick = closePlaceModal;

            const modal = document.createElement('div');
            modal.className = 'place-details-modal';
            modal.innerHTML = `
        <div class="place-details-header">
            <img src="${foto}" alt="${nama}" onerror="this.src='${isWisata ? '/images/default-heritage.jpg' : '/images/default-culinary.jpg'}'">
            <button class="place-details-close" onclick="closePlaceModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <div class="place-details-content">
            <h3 class="place-details-title">${nama}</h3>
            <div class="place-details-tags">
                ${isWisata
                    ? '<span class="place-tag"><i class="bi bi-geo-alt-fill"></i>Tourism</span>'
                    : '<span class="place-tag" style="background: #fff3e0; color: #e65100;"><i class="bi bi-cup-hot-fill"></i>Culinary</span>'
                }
                ${kategoriTags}
            </div>
            ${shortDesc ? `<p class="place-details-description">${shortDesc}</p>` : ''}
        </div>
        <div class="place-details-footer">
            <a href="${detailUrl}" class="btn-view-details">
                <span>View Details</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    `;

            document.body.appendChild(overlay);
            document.body.appendChild(modal);
            document.body.style.overflow = 'hidden';
        }

        // Close Place Modal
        function closePlaceModal() {
            const overlay = document.querySelector('.place-details-overlay');
            const modal = document.querySelector('.place-details-modal');

            if (overlay) overlay.remove();
            if (modal) modal.remove();
            document.body.style.overflow = 'auto';
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePlaceModal();
            }
        });

        // Store active filters
        let activeWisataFilter = 'semua';
        let activeKulinerFilter = 'semua';

        // Filter Wisata
        function filterWisata() {
            const filter = document.getElementById('wisataFilter').value;
            activeWisataFilter = filter;

            let visibleCount = 0;

            wisataMarkers.forEach(marker => {
                const kategoriList = marker.options.kategori.split(',').filter(k => k !== '');

                if (filter === 'semua') {
                    marker.addTo(map);
                    visibleCount++;
                } else if (kategoriList.includes(filter)) {
                    marker.addTo(map);
                    visibleCount++;
                } else {
                    map.removeLayer(marker);
                }
            });

            showFilterNotification(`Showing ${visibleCount} tourism destination(s)`);
            updatePlaceList('wisata', filter);
        }

        // Filter Kuliner
        function filterKuliner() {
            const filter = document.getElementById('kulinerFilter').value;
            activeKulinerFilter = filter;

            let visibleCount = 0;

            kulinerMarkers.forEach(marker => {
                const kategoriList = marker.options.kategori.split(',').filter(k => k !== '');

                if (filter === 'semua') {
                    marker.addTo(map);
                    visibleCount++;
                } else if (kategoriList.includes(filter)) {
                    marker.addTo(map);
                    visibleCount++;
                } else {
                    map.removeLayer(marker);
                }
            });

            showFilterNotification(`Showing ${visibleCount} culinary spot(s)`);
            updatePlaceList('kuliner', filter);
        }

        // Show filter notification
        function showFilterNotification(message) {
            const notification = document.createElement('div');
            notification.style.cssText = `
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 50px;
            box-shadow: 0 5px 20px rgba(46, 125, 50, 0.4);
            z-index: 10000;
            animation: slideInRight 0.3s ease;
            font-weight: 500;
        `;
            notification.innerHTML = `<i class="bi bi-check-circle me-2"></i>${message}`;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 2000);
        }

        // Update place list based on active filters
        function updatePlaceList(type, filter) {
            const placeList = document.querySelector('.place-list');
            let html = '<h6 class="fw-bold mb-3">Filtered Places</h6>';
            let count = 0;

            if (type === 'wisata' || activeWisataFilter !== 'semua') {
                wisataMarkers.forEach(marker => {
                    if (map.hasLayer(marker) && count < 5) {
                        const latLng = marker.getLatLng();
                        const markerId = marker.options.id || '';
                        html += `
                        <div class="place-item" onclick="showPlaceDetails(${latLng.lat}, ${latLng.lng}, 'wisata', '${markerId}')">
                            <h6><i class="bi bi-geo-alt-fill" style="color: #2196F3;"></i> ${marker.options.nama}</h6>
                            <small><i class="bi bi-tag me-1"></i>Tourism Destination</small>
                        </div>
                    `;
                        count++;
                    }
                });
            }

            if (type === 'kuliner' || activeKulinerFilter !== 'semua') {
                kulinerMarkers.forEach(marker => {
                    if (map.hasLayer(marker) && count < 5) {
                        const latLng = marker.getLatLng();
                        const markerId = marker.options.id || '';
                        html += `
                        <div class="place-item" onclick="showPlaceDetails(${latLng.lat}, ${latLng.lng}, 'kuliner', '${markerId}')">
                            <h6><i class="bi bi-cup-hot-fill" style="color: #f44336;"></i> ${marker.options.nama}</h6>
                            <small><i class="bi bi-tag me-1"></i>Culinary Spot</small>
                        </div>
                    `;
                        count++;
                    }
                });
            }

            if (count === 0) {
                html += `
                <div class="text-center p-3">
                    <i class="bi bi-search" style="font-size: 32px; color: #ccc;"></i>
                    <p class="mt-2 mb-0 text-muted">No places match the filter</p>
                </div>
            `;
            }

            placeList.innerHTML = html;
        }

        // Reset all filters
        function resetFilters() {
            document.getElementById('wisataFilter').value = 'semua';
            document.getElementById('kulinerFilter').value = 'semua';
            activeWisataFilter = 'semua';
            activeKulinerFilter = 'semua';

            wisataMarkers.forEach(marker => marker.addTo(map));
            kulinerMarkers.forEach(marker => marker.addTo(map));

            showFilterNotification('All filters reset');
            resetPlaceList();
        }

        // Reset place list to popular places
        function resetPlaceList() {
            const placeList = document.querySelector('.place-list');
            let html = '<h6 class="fw-bold mb-3">Popular Places</h6>';

            @foreach ($wisata->take(5) as $w)
                html += `
                <div class="place-item" onclick="showPlaceDetails({{ $w->latitude }}, {{ $w->longitude }}, 'wisata', '{{ $w->id_wisata }}')">
                    <h6>{{ $w->nama_wisata }}</h6>
                    <small><i class="bi bi-geo-alt me-1"></i>Tourism Destination</small>
                </div>
            `;
            @endforeach

            placeList.innerHTML = html;
        }

        // Store user location marker
        let userLocationMarker = null;
        let nearbyCircle = null;

        // Get Nearby Places
        function getNearby() {
            if (navigator.geolocation) {
                const placeList = document.querySelector('.place-list');
                placeList.innerHTML =
                    '<div class="text-center p-3"><i class="bi bi-hourglass-split"></i> Getting your location...</div>';

                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;

                        map.setView([userLat, userLng], 14);

                        if (userLocationMarker) {
                            map.removeLayer(userLocationMarker);
                        }
                        if (nearbyCircle) {
                            map.removeLayer(nearbyCircle);
                        }

                        const userIcon = L.icon({
                            iconUrl: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png',
                            iconSize: [32, 32],
                            iconAnchor: [16, 32]
                        });

                        userLocationMarker = L.marker([userLat, userLng], {
                                icon: userIcon
                            })
                            .addTo(map)
                            .bindPopup('<strong>Your Location</strong>')
                            .openPopup();

                        nearbyCircle = L.circle([userLat, userLng], {
                            color: '#2e7d32',
                            fillColor: '#4caf50',
                            fillOpacity: 0.1,
                            radius: 500
                        }).addTo(map);

                        let nearbyPlaces = [];

                        wisataMarkers.forEach(marker => {
                            const markerLatLng = marker.getLatLng();
                            const distance = map.distance([userLat, userLng], [markerLatLng.lat, markerLatLng
                                .lng
                            ]);

                            if (distance <= 500) {
                                nearbyPlaces.push({
                                    nama: marker.options.nama,
                                    lat: markerLatLng.lat,
                                    lng: markerLatLng.lng,
                                    distance: distance,
                                    tipe: 'Tourism',
                                    realType: 'wisata',
                                    icon: 'bi-geo-alt-fill',
                                    color: '#2196F3',
                                    id: marker.options.id || ''
                                });
                            }
                        });

                        kulinerMarkers.forEach(marker => {
                            const markerLatLng = marker.getLatLng();
                            const distance = map.distance([userLat, userLng], [markerLatLng.lat, markerLatLng
                                .lng
                            ]);

                            if (distance <= 500) {
                                nearbyPlaces.push({
                                    nama: marker.options.nama,
                                    lat: markerLatLng.lat,
                                    lng: markerLatLng.lng,
                                    distance: distance,
                                    tipe: 'Culinary',
                                    realType: 'kuliner',
                                    icon: 'bi-cup-hot-fill',
                                    color: '#f44336',
                                    id: marker.options.id || ''
                                });
                            }
                        });

                        nearbyPlaces.sort((a, b) => a.distance - b.distance);

                        if (nearbyPlaces.length === 0) {
                            placeList.innerHTML = `
                            <div class="text-center p-3">
                                <i class="bi bi-info-circle" style="font-size: 32px; color: #ff9800;"></i>
                                <p class="mt-2 mb-0">No places found within 2.5 km radius</p>
                            </div>
                        `;
                        } else {
                            let html =
                                '<h6 class="fw-bold mb-3"><i class="bi bi-compass me-2"></i>Nearby Places (Within 0.5 km)</h6>';

                            nearbyPlaces.slice(0, 10).forEach(place => {
                                const distanceKm = (place.distance / 1000).toFixed(2);
                                html += `
                                <div class="place-item" onclick="showPlaceDetails(${place.lat}, ${place.lng}, '${place.realType}', '${place.id}')">
                                    <h6><i class="${place.icon}" style="color: ${place.color};"></i> ${place.nama}</h6>
                                    <small>
                                        <i class="bi bi-signpost-2 me-1"></i>${distanceKm} km away • ${place.tipe}
                                    </small>
                                </div>
                            `;
                            });

                            if (nearbyPlaces.length > 10) {
                                html +=
                                    `<p class="text-center text-muted small mt-2">Showing 10 of ${nearbyPlaces.length} nearby places</p>`;
                            }

                            placeList.innerHTML = html;
                        }
                    },
                    function(error) {
                        placeList.innerHTML = `
                        <div class="text-center p-3">
                            <i class="bi bi-exclamation-triangle" style="font-size: 32px; color: #f44336;"></i>
                            <p class="mt-2 mb-0">Unable to get your location. Please enable location services.</p>
                        </div>
                    `;
                        console.error('Geolocation error:', error);
                    }
                );
            } else {
                alert('Geolocation is not supported by your browser.');
            }
        }

        // Map Search
        function searchOnMap() {
            const query = document.getElementById('mapSearch').value.toLowerCase();

            if (query.length < 2) return;

            let found = false;

            wisataMarkers.forEach(marker => {
                if (marker.options.nama.toLowerCase().includes(query)) {
                    marker.openPopup();
                    map.setView(marker.getLatLng(), 16);
                    found = true;
                }
            });

            if (!found) {
                kulinerMarkers.forEach(marker => {
                    if (marker.options.nama.toLowerCase().includes(query)) {
                        marker.openPopup();
                        map.setView(marker.getLatLng(), 16);
                        found = true;
                    }
                });
            }
        }

        // Animation on Scroll
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.destination-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });

        document.querySelectorAll('.stat-item').forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            item.style.transition = 'all 0.6s ease';
            observer.observe(item);
        });
    </script>
</body>

</html>
