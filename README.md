# Tambang Nikel

<h1 align="center">
<img align="center" height="80px" width="80px" src="https://github.com/iamwilldev/Kumpulan-Dataset/blob/cc67a9a3c8f5704a8f63832db0adc7b21c24aec7/Github/kai.png" alt="Kai-icon">
 Kai
</h1>
<p align="center">
This is a technical test backend developer from PT Sekawan Media Informatika with a case study of a nickel company that needs an application to be able to monitor its vehicles.
</p>

<p align="center">
  <a href="#features">Features</a> •
  <a href="#building-from-source">Building from source</a> •
  <a href="#preview-web">Preview</a> •
  <a href="#support">Support</a> •
</p>

![image](https://github.com/iamwilldev/Kumpulan-Dataset/blob/657ec09dcf671d804296122a68eeeb8174addcc9/Github/screencapture-127-0-0-1-8000-dashboard-booking-bookings-2024-03-07-00_36_58.png)


## Features

- There are 2 users (admin and approver)
- There is a dashboard that displays a graph of vehicle usage
- Driver management
- Vehicle management
- Bookings management
- Activity log

## Building from Source

Ensure you have [Python 3.11.5](https://www.python.org/downloads/) and [Git](https://github.com/git-guides/install-git) installed.

Open a terminal and run the following commands.

1. **Set everything up.**

- Linux/Mac/Windows (Command Prompt)

```
git clone https://github.com/iamwilldev/technical-test.git && cd technical-test && composer update && cp .env.example .env && php artisan key:generate && php artisan migrate && php artisan db:seed && php artisan serve
```

2. **Authentication**
- Admin : `admin@gmail.com` / `password`
- Approval 1 (Kantor Cabang) : `approval1@gmail.com` / `password`
- Approval 2 (Kantor Pusat) : `approval2@gmail.com` / `password`

3. **Requirement**
- Database : `Mysql 8`
- PHP : `php 8.2`
- Framework : `Laravel 10`

4. **PDM or database design**

![image](https://github.com/iamwilldev/Kumpulan-Dataset/blob/708319074fd1c6d90d382e5e1a8d5c517bed6df6/Github/pdm.png)

## Preview Web

Some previews of web features

1. **Role Admin**

- Dashboard

![image](https://github.com/iamwilldev/Kumpulan-Dataset/blob/473690d8fa8316ded9e3da8de67a33875e878ac0/Github/screencapture-127-0-0-1-8000-dashboard-2024-03-07-01_15_25.png)

- Driver management

![image](https://github.com/iamwilldev/Kumpulan-Dataset/blob/473690d8fa8316ded9e3da8de67a33875e878ac0/Github/screencapture-127-0-0-1-8000-dashboard-driver-drivers-2024-03-07-01_15_49.png)

- Vehicle management

![image](https://github.com/iamwilldev/Kumpulan-Dataset/blob/473690d8fa8316ded9e3da8de67a33875e878ac0/Github/screencapture-127-0-0-1-8000-dashboard-vehicle-vehicles-2024-03-07-01_15_57.png)

- Booking management

![image](https://github.com/iamwilldev/Kumpulan-Dataset/blob/657ec09dcf671d804296122a68eeeb8174addcc9/Github/screencapture-127-0-0-1-8000-dashboard-booking-bookings-2024-03-07-00_36_58.png)

- Log Activity

![image](https://github.com/iamwilldev/Kumpulan-Dataset/blob/473690d8fa8316ded9e3da8de67a33875e878ac0/Github/screencapture-127-0-0-1-8000-dashboard-logs-activity-2024-03-07-01_16_12.png)

2. **Role Approval 1**
- Booking approval

![image](https://github.com/iamwilldev/Kumpulan-Dataset/blob/473690d8fa8316ded9e3da8de67a33875e878ac0/Github/screencapture-127-0-0-1-8000-dashboard-booking-bookings-2024-03-07-01_18_34.png)

3. **Role Approval 2**
- Booking approval

![image](https://github.com/iamwilldev/Kumpulan-Dataset/blob/473690d8fa8316ded9e3da8de67a33875e878ac0/Github/screencapture-127-0-0-1-8000-dashboard-booking-bookings-2024-03-07-01_19_03.png)

## Support

- You can support the development of Tambang Nikel through donations on [GitHub Sponsors]().
- You can also leave a star on the github for more weebs to know about it.
- Tambang Nikel is open to pull requests, so if you have ideas for improvements, feel free to contribute!
