#include <iostream>

// Check for known headers
#ifdef __has_include
#  if __has_include(<iostream>)
#    define HAS_IOSTREAM 1
#  endif
#  if __has_include(<vector>)
#    define HAS_VECTOR 1
#  endif
#  if __has_include(<string>)
#    define HAS_STRING 1
#  endif
#endif

int main() {
    std::cout << "Header files included:\n";

#ifdef HAS_IOSTREAM
    std::cout << " - <iostream>\n";
#endif
#ifdef HAS_VECTOR
    std::cout << " - <vector>\n";
#endif
#ifdef HAS_STRING
    std::cout << " - <string>\n";
#endif

    return 0;
}
