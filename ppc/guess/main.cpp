#include <iostream>
#include <vector>
#include <cstdlib>
#include <ctime>

std::string FLAG = "PolyCTF{flag_plug}";

std::pair<int, std::vector<int>> get_random(std::vector<int>& array) {
    int i = rand() % array.size();
    int value = array[i];
    array.erase(array.begin() + i);
    return {value, array};
}

int game(int points, int round) {
    int DIFFICULTY = 10 + round;
    std::vector<int> loot(DIFFICULTY);
    for (int i = 0; i < DIFFICULTY; ++i) {
        loot[i] = i + 1;
    }
    
    while (points > 0 && !loot.empty()) {
        int index;
        std::cin >> index;

        // Uncomment the following lines if you want to check if index is in loot
        // if (std::find(loot.begin(), loot.end(), index) == loot.end()) {
        //     std::cout << "Атата" << std::endl;
        //     return 0;
        // }
        
        auto [x, new_loot] = get_random(loot);
        loot = new_loot;
        
        if (index == x) {
            return points * DIFFICULTY;
        } else {
            std::cout << "Не угадал, ещё разочек. Теперь другое число." << std::endl;
            points -= points / DIFFICULTY;
        }
    }
    std::cout << "Ну ты лошара" << std::endl;
    return 0;
}

int main() {
    srand(static_cast<unsigned int>(time(0)));
    
    int Q = 100;
    int POINTS = 3000;

    std::cout << "Старая игра угадай число!" << std::endl;

    for (int round = 0; round < Q; ++round) {
        std::cout << "Сделай ставку, сейчас у тебя " << POINTS << std::endl;
        int points;
        std::cin >> points;
        while (points > POINTS) {
            std::cout << "Губа не дура. Но давай ка ещё раз попытайся" << std::endl;
            std::cin >> points;
        }
        
        POINTS -= points;
        std::cout << "Игра на " << points << " очков" << std::endl;
        int p = game(points, round);
        POINTS += p / 6;
        
        if (POINTS <= 0) {
            std::cout << "Вас выгнали из-за долгов" << std::endl;
            return 0;
        }
    }

    std::cout << FLAG << std::endl;
    return 0;
}


