<?php

namespace Mizanchan22\Im14Ol;

class Installer
{
    public function run()
    {
        echo "\n\033[1;34m🔧 Heylo, nak try install R&D IM1?\033[0m\n";
        echo "===========================\n";
        echo "[1]  Nak guna template apa? Boleh switch theme jugak. (AdminLTE etc)\n";
        echo "[2]  Nak buat CRUD? (Complete Model, View, Controller + Update Route *Sekali cth standard security yg dh implement*)\n";
        echo "[3]  Nak publish semua reusable component (CELL)? (Modal, SweetAlert etc)\n";
        echo "[4]  Install CI4 Shield (Complete role permission etc)\n";
        echo "[5]  Tutorial ada dalam  <<README.md>>\n";
        echo "[6]  Login (LDAP/public/mix)\n";
        echo "[7]  Nak template surat-surat rasmi/tak rasmi? \n";
        echo "[8]  Nak install aliran kerja?\n";
        echo "[9]  Nak buat option dwibahasa (dropdown)? (BM,EN)\n";
        echo "[0]  Exit\n";
        echo "Choose an option: ";

        $choice = trim(fgets(STDIN));
        match($choice) {
            '1' => $this->genTemplate(),
            '2' => $this->genCRUD(),
            '3' => $this->genComponent(),
            '4' => $this->installShield(),
            '5' => $this->showTutorial(),
            '6' => $this->genLogin(),
            '7' => $this->genSurat(),
            '8' => $this->genAliranKerja(),
            '9' => $this->genLanguage(),
            default => exit("Bye! Nak isntall balik boleh run command ni --> \n")
        };
    }

    private function genTemplate()
    {
        echo "✅ Generating Template...\n";
        // system("composer create-project codeigniter4/appstarter my-ci4-app");
    }

    private function genCRUD()
    {
        echo "🎨 Genrating CRUD...\n";
    }

    private function genComponent()
    {
        echo "🎨 Generating Component...\n";
    }

    private function installShield()
    {
        echo "🛡️ Installing Shield...\n";
    }

    private function showTutorial()
    {
        echo "📖 Showing Tutorial...\n";
    }

    private function genLogin()
    {
        echo "🔑 Generating Login...\n";
    }

    private function genSurat()
    {
        echo "📝 Generating Surat...\n";
    }

    private function genAliranKerja()
    {
        echo "📝 Generating Aliran Kerja...\n";
    }

    private function genLanguage()
    {
        echo "📝 Generating Language...\n";
    }
}